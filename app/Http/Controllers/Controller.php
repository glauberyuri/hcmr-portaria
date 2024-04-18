<?php

namespace App\Http\Controllers;

use App\Models\Portaria;
use App\Models\Visitante;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Yajra\DataTables\DataTables;
use PDO;
use DB;
use function Laravel\Prompts\search;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    private $dbh;

    function __construct()

    {
        try {

            $server = "172.17.3.149";
            $db_username = "dbamv";
            $db_password = "odp3j#";
            $service_name = "mv2000_wd6_gru.snfunmvdb.funvcnmvprod.oraclevcn.com";
            $sid = "ORCL";
            $port = 1521;
            $dbtns = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = $server)(PORT = $port)) (CONNECT_DATA = (SERVICE_NAME = $service_name) (SID = $sid)))";

            //$this->dbh = new PDO("mysql:host=".$server.";dbname=".dbname, $db_username, $db_password);

            $this->dbh = new PDO("oci:dbname=" . $dbtns . ";charset=utf8", $db_username, $db_password, array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC)
            );
        } catch (PDOException $e) {
            echo ($e->getMessage()=='could not find driver' ? 'Driver não encontrado, verifique a extensão no arquivo php.ini' : $e->getMessage());
        }
    }
    function __destruct()
    {
        $this->dbh = NULL;
    }
    public function select($sql)
    {
        try {
            $sql_stmt = $this->dbh->prepare($sql);
            $sql_stmt->execute();
            $result = $sql_stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle the exception, log the error, or echo the error message for debugging.
            // You can access the error message with $e->getMessage().
            // For example: echo "SQL Error: " . $e->getMessage();
        } finally {
            $this->__destruct();
        }
    }


    public function GetPaciente(Request $request){
        $id = $request->id;
        $paciente = $this->select(
            "select
                            p.nm_paciente as PACIENTE,
                            a.cd_atendimento as CD_ATEND,
                            tp.ds_tipo_internacao as TP_INTERNACAO,
                            u.ds_unid_int as UNID_INTERNACAO,
                            s.nm_setor as SETOR,
                            l.cd_leito as CD_LEITO,
                            l.ds_leito as LEITO
                            from
                            atendime a inner join leito l
                            on a.cd_leito = l.cd_leito
                            inner join unid_int u on u.cd_unid_int = l.cd_unid_int
                            inner join setor s
                            on s.cd_setor = u.cd_setor
                            inner join paciente p on p.cd_paciente = a.cd_paciente
                            inner join tipo_internacao tp on tp.cd_tipo_internacao = a.cd_tipo_internacao
                            where s.cd_multi_empresa = 21 and u.sn_ativo = 'S' and (a.dt_alta_medica is null and a.dt_alta is null) and a.cd_atendimento = $id
                            ORDER BY u.DS_UNID_INT,a.dt_atendimento,p.nm_paciente"
        );
        return response()->json($paciente);
    }

    public function dashboard(Request $request)
    {

        return view ('dashboard');
    }
    public function SearchPaciente(Request $request) {
        // Verifique se $request->search não está vazio antes de executar a consulta.
        $search = strtoupper($request->search);
        if (!empty($request->search)) {
            $sql = "SELECT DISTINCT *
                        FROM (
                            SELECT
                        p.nm_paciente as PACIENTE,
                        a.cd_atendimento as CD_ATEND,
                        u.ds_unid_int as UNID_INTERNACAO
                    FROM
                        atendime a
                        INNER JOIN leito l ON a.cd_leito = l.cd_leito
                        INNER JOIN unid_int u ON u.cd_unid_int = l.cd_unid_int
                        INNER JOIN setor s ON s.cd_setor = u.cd_setor
                        INNER JOIN paciente p ON p.cd_paciente = a.cd_paciente
                        INNER JOIN tipo_internacao tp ON tp.cd_tipo_internacao = a.cd_tipo_internacao
                    WHERE
                        s.cd_multi_empresa = 21
                        AND u.sn_ativo = 'S'
                        AND (a.dt_alta_medica IS NULL AND a.dt_alta IS NULL)
                        AND p.nm_paciente LIKE '%" . $search . "%'
                    ORDER BY
                        u.ds_unid_int, a.dt_atendimento, p.nm_paciente
                )
                WHERE ROWNUM <= 5";

            $data = DB::connection('oracle')->select($sql);
            //dd($data);
            $output = '';
            if (!empty($data)) {
                $output = '
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nome Paciente</th>
                    <th scope="col">Unidade de Internação</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>';
                foreach ($data as $row) {
                    $output .= '
            <tr>
                <th scope="row">' . $row->cd_atend . '</th>
                <td>' . $row->paciente . '</td>
                <td>' . $row->unid_internacao . '</td>
                <td>
                    <button class="h-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded gerarVisita" id="' . $row->cd_atend . '">Visitar</button>
                </td>
            </tr>';
                }
                $output .= '
            </tbody>
        </table>';
            } else {
                $output .= 'Nenhum paciente encontrado';
            }
            return $output;
        } else {
            return ''; // Retorna uma string vazia se $request->search estiver vazio.
        }
    }



    public function home(){

        return view ('home');
    }


    public function getVisitanteList()
    {

        $visitantes = Portaria::join('visitantes', 'portarias.visitante_id', '=', 'visitantes.id')
            ->get();
        return DataTables::of($visitantes)->make(true);
    }

        public function getVisitante(Request $request){
            $visitantes = Visitante::where('nome_visitante', 'like', '%'.$request->searchItem.'%' );
            return $visitantes->paginate(10, ['*'], 'page', $request->page);
        }

    }

