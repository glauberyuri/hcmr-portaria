import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(document).ready(function() {
    var dataTable = $('#lista-visitantes').DataTable({
        paging: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json',
        },
        processing: true,
        serverSide: true,
        order: [],
        info: true,
        ajax: {
            url: '/getVisitanteList',
        },
        columns: [
            { data: 'nome_paciente' },
            { data: 'unidade_internacao'},
            { data: 'nome_visitante'},
            { data: 'parentesco_visitante'},
            { data: 'observacao'},
            {
                data: 'created_at',
                render: function(data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        // Formate o valor 'created_at' para exibir apenas o dia e a hora.
                        var date = new Date(data);
                        var formattedDate = date.toLocaleString('pt-BR', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' });
                        return formattedDate;
                    }
                    return data; // Mantenha o valor original para classificação e filtragem.
                }
            }
        ],
        columnDefs: [
            {
                "targets": [0, 3, 4],
                className: "dt-body-left",
                "orderable": false
            }
        ]
    });
});

$(function() {
    $("#add_visita_form").submit(function (e){
        e.preventDefault();
        $("#btn_visita_novo").text('adicionando...');
        const fd = new FormData(this);
        $.ajax({
            url: '/storeportaria',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if(response.status == 200){
                    console
                    Swal.fire(
                        'Visita Realizada!',
                        'Boas vindas ao nosso Hospital das Clinicas',
                        'success'
                    )
                }
                $("#btn_visita_novo").text('Salvar');
                $("#add_visita_form")[0].reset();
                $("#ModelVisitaHospitalar").modal('hide');
            }
        });
    });



    $(function (){
        $("#visitanteSelect").select2({
            ajax:{
                url: '/getVisitante',
                type:'get',
                dataType: 'json',
                delay:250,
                data:function(params){
                    return {
                        searchItem:params.term,
                        page:params.page
                    }
                },
                processResults:function(data,params)
                {
                    params.page=params.page||1;
                    return {
                        results: data.data,
                        pagination: {
                            more:data.last_page!=params.page
                        }
                    }
                },
                cache:true,
            },
            placeholder: 'Procurar Visitante',
            dropdownParent: $('#ModelVisitaHospitalar'),
            templateResult: templateResult,
            templateSelection: templateSelection
        })
    });

    function templateResult(data){
        if(data.loading)
        {
            return data.text
        }
        return data.nome_visitante
    }

    function templateSelection(data){
        return data.nome_visitante
    }


    //GET SEARCH PACIENTES
    $(document).ready(function(){
       $('#Btn_Pesquisar').on('click', function (){
           var query = $('#GetPaciente').val();

           $('#loading').show();
           $.ajax({
               url:"/internados",
               type:"GET",
               data: {'search' : query},
               success: function(data){
                   $('#searh_list').html(data);
               },
               complete: function(){
                   // Ocultar o indicador de carregamento após a conclusão da requisição AJAX
                   $('#loading').hide();
               }

           })
       })
    });

    $(document).on('click', '.gerarVisita', function (e){
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: '/getPaciente',
            method: 'get',
            data: {
                id: id
            },
            success: function (response){
                // Verifique se o retorno é uma matriz e se contém pelo menos um elemento.
                if (Array.isArray(response) && response.length > 0) {
                    // Acesse os dados do paciente no primeiro elemento da matriz.
                    var paciente = response[0];
                    $("#nome_paciente").val(paciente.PACIENTE);
                    $("#unidade_internacao").val(paciente.UNID_INTERNACAO);
                }
                $("#ModelVisitaHospitalar").modal('show');
            }
        })
    })
});

$(".js-example-theme-single").select2({
    theme: "classic"
});

$(function() {
    $("#add_visitante_form").submit(function (e) {
        e.preventDefault();
        $("#btn_add_visitante").text('adicionando...');
        const fd = new FormData(this);
        $.ajax({
            url: '/storeVisitante',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    Swal.fire(
                        'Novo Visitante!',
                        'Boas vindas ao nosso novo visitante',
                        'success'
                    )
                }
                $("#btn_add_visitante").text('Salvar');
                $("#add_visitante_form")[0].reset();
                $("#ModelVisitanteNovo").modal('hide');
            }
        });
    });
});

