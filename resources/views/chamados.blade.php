@extends('layouts.app')
@section('title', 'Dashboard')
@section('page', 'Chamados')
@section('content')

<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="dropdown float-end">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>

            <h4 class="header-title mb-3">Listagem de Chamados</h4>

            <div class="row justify-content-between mb-2">
            <div class="col-auto">
                <form>
                    <div class="mb-2">

                        <select id="filter-category" class="form-select">
                            <option value="">Selecione uma categoria</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-auto">
                <form>
                    <div class="mb-2">
                       <select id="filter-status" class="form-select">
                            <option value="">Selecione um status</option>
                            <option value="Aberto">Aberto</option>
                            <option value="Em_Progresso">Em Progresso</option>
                            <option value="Resolvido">Resolvido</option>
                        </select>
                    </div>
                </form>
            </div>

             <div class="col-auto">
                <div class="mb-2">
                </div>
            </div>
            
            <div class="col-sm-8">
                <div class="text-sm-end">
                    <button type="button" class="btn btn-primary waves-effect waves-light mb-2 new" data-bs-toggle="modal" data-bs-target="#signup-modal">Novo Chamado</button>
                </div>
            </div><!-- end col-->
            </div>

            

            <div class="table-responsive">
                <table class="table table-borderless table-nowrap table-hover table-centered m-0 tickets-table">

                    <thead class="table-light">
                        <tr>
                            <th>Titulo</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    </tbody>
                </table>

                <br>
                <nav id="paginacao" class="d-flex justify-content-center"></nav>
            </div> <!-- end .table-responsive-->
        </div>
    </div> <!-- end card-->
</div>
<!-- Signup modal content -->
<div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">

                <form class="px-3" id="form-ticket" action="#">

                    <div class="mb-3">
                        <label for="title" class="form-label">Titulo</label>
                        <input class="form-control form-edit" type="text" id="title" name="title"  required="" placeholder="Titulo...">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control form-edit" name="data[description]" id="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select name="data[category_id]" id="category_id" class="form-control form-edit">
                            <option value="">Selecione uma categoria</option>
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <label for="status_id" class="form-label">Status</label>
                        <select name="data[status_id]" id="status_id" class="form-control form-edit">
                            <option value="Aberto">Aberto</option>
                            <option value="Em_Progresso">Em_Progresso</option>
                            <option value="Resolvido">Resolvido</option>
                        </select>
                    </div>

                    <div class="mb-3 text-center">

                        <button id="bto-action" class="btn btn-primary save-update " type="submit"> Alterar</button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@push('scripts')
<script>
    var ticket_id = null;
    loadTickets(0);
    getDataAllCategories('filter-category');

    $(document).ready(function() {

        // Abre modal para criação de um novo registro
        $(document).on('click', '.new', function() {
            $('#bto-action').removeClass('save-update').addClass('save-create').text('Salvar');
            getDataModal('', 'category_id');
        });

        // Abre modal com valor do id vindo da linha de listagem
        $(document).on('click', '.update', function() {
            ticket_id = $(this).attr('data-id-ticket');
            $('#bto-action').removeClass('save-create').addClass('save-update').text('Atualizar');
            getDataModal(ticket_id, 'category_id');
        });

        $(document).on('change', '#filter-category', function() {
            loadTickets(0);
        });

        $(document).on('change', '#filter-status', function() {
            loadTickets(0);
        });
        
        //-----------------------------------------------------------------------------------------------

        // Deleta registro do banco.
        $(document).on('click', '.btn-danger', function() {
            ticket_id = $(this).attr('data-id-ticket');
            deleteRow();
        });

        // Atualiza registro modificado no form
        $(document).on('click', '.save-update', function(event) {
            event.preventDefault();
            update();
        });

        // Cria um novo registro
        $(document).on('click', '.save-create', function(event) {
            event.preventDefault();
            save();
        });
    });

    function loadTickets(page){

        let data = {
            'category_id': $('#filter-category').val(),
            'status': $('#filter-status').val()
        }

        $.ajax({
            url: `http://127.0.0.1:8000/api/tickets?page=${page}`,
            method: 'GET',
            data: data,
            dataType: 'json',
            beforeSend: function () {
               const spinnerRow = `
                    <tr>
                        <td colspan="5" class="text-center align-middle">
                            <div class="spinner-border text-primary m-2" role="status"></div>
                        </td>
                    </tr>
                `;

                $('.tickets-table tbody').html(spinnerRow);
            },
            success: function (tickets) {
                let rows = '';
                let pages = tickets.data;

                if (tickets.data.length === 0) {
                    rows = '<tr><td colspan="5" class="text-center">Nenhum ticket encontrado</td></tr>';
                } else {
                    
                    $.each(tickets.data.data, function (index, ticket) {
                        let formatDescription = truncate(ticket.description);
                        rows += `
                            <tr>
                                <td>${ticket.title}</td>
                                <td>${formatDescription}</td>
                                <td>${ticket.category_name}</td>
                                <td><span class="badge bg-secondary">${ticket.status}</span></td>
                                <td><a href="javascript: void(0);" class="btn btn-xs btn-light update" data-bs-toggle="modal" data-bs-target="#signup-modal" data-id-ticket="${ticket.id}"><i class="mdi mdi-pencil"></i></a>
                                <a href="javascript: void(0);" class="btn btn-xs btn-danger" data-id-ticket="${ticket.id}"><i class="mdi mdi-minus"></i></a></td>
                            </tr>
                        `;
                    });

                    renderPagination(pages);
                }

                $('.tickets-table tbody').html(rows);
            },
            error: function () {
                toastr.error('Erro ao gerar a lista tickets');
            }
        });
    }

    function getDataModal(ticket_id, div){
        
        $('#form-ticket')[0].reset();
        getDataAllCategories(div);
        
        if(ticket_id > 0){

            $.ajax({
                url: 'http://127.0.0.1:8000/api/tickets/'+ticket_id,
                method: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.tickets-table tbody').html('<div class="spinner-border text-primary m-2" role="status"></div>');
                },
                success: function (ticket) {

                    if (ticket.data.length === 0) {
                        toastr.error('Nenhum ticket encontrado!');
                    } else {

                        $('#title').val(ticket.data.title);
                        $('#description').val(ticket.data.description);
                        $('#category_id').val(ticket.data.category_id).trigger('change');
                        $('#status_id').val(ticket.data.status).change();
                    }
                    loadTickets();
                },
                error: function () {
                    toastr.error('Erro ao gerar dados!');
                }
            });
        }
    }

    function getDataAllCategories(div){

        $.ajax({
            url: 'http://127.0.0.1:8000/api/categories',
            method: 'GET',
            dataType: 'json',
            success: function (categories) {

                let data = categories.data.data;
                let selectbox = $('#'+div);
                    selectbox.find('option').remove();
                    $('<option>').val('').text('Selecione uma categoria').appendTo(selectbox);
                        
                $.each(data, function (index, categorie) {
                    $('<option>').val(categorie.id).text(categorie.name).appendTo(selectbox);
                });
            },
            error: function () {
                toastr.error('Erro ao gerar a lista categorias');
            }
        });
    }

    function update(){

        let data = {
            'title':$('#title').val(),
            'description': $('#description').val(),
            'category_id': $('#category_id').val(),
            'status': $('#status_id').val()
        }

        $.ajax({
            url: 'http://127.0.0.1:8000/api/tickets/'+ticket_id,
            method: 'PUT',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            beforeSend: function () {
                
                let btnSpinner = `<button class="btn btn-primary" type="button" disabled="">
                                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                    Loading...
                                  </button>`;
                
                $('.save').html(btnSpinner);
            },
            success: function (ticket) {
                if (ticket.status) {
                    
                    toastr.success(ticket.message);

                    const modalEl = document.getElementById('signup-modal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    modalInstance.hide();
                }
                $('.save').html('<button class="btn btn-primary save" type="submit"> Alterar</button>');
                loadTickets();
            },
            error: function (xhr) {
                console.log(xhr.responseJSON);
                $('.save').html('<button class="btn btn-primary save" type="submit"> Alterar</button>');
                toastr.error('Erro ao gerar dados!');
            }
        });
    }

    function save(){

        let data = {
            'title':$('#title').val(),
            'description': $('#description').val(),
            'category_id': $('#category_id').val(),
            'status': $('#status_id').val()
        }

        $.ajax({
            url: 'http://127.0.0.1:8000/api/tickets/',
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(data),
            beforeSend: function () {
                
                let btnSpinner = `<button class="btn btn-primary" type="button" disabled="">
                                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                    Loading...
                                  </button>`;
                
                $('#bto-action').html(btnSpinner);
            },
            success: function (ticket) {
                if (ticket.status) {
                    
                    toastr.success(ticket.message);

                    const modalEl = document.getElementById('signup-modal');
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    modalInstance.hide();
                }

                $('#bto-action').html('<button id="bto-action" class="btn btn-primary save-create" type="submit"> Alterar</button>');
                loadTickets();
            },
            error: function (xhr) {
                console.log(xhr.responseJSON);
                $('#bto-action').html('<button id="bto-action" class="btn btn-primary save-create" type="submit"> Alterar</button>');
                toastr.error('Erro ao gerar dados!');
            }
        });
    }

    function truncate(text, maxLength = 85) {
        return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
    }
 
    function renderPagination(res) {

        const current = res.current_page;
        const last = res.last_page;
    
        let pag = '<ul id="paginacao" class="pagination pagination-rounded">';

            if (res.prev_page_url) {
            pag += `<li class="page-item">
                        <a class="page-link" href="javascript: void(0);" onclick="loadTickets(${current - 1})" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                        </a>
                    </li>`;
            }

        for (let i = 1; i <= last; i++) {
            let active = i === current ? 'active' : '';
            pag += `<li class="page-item active"><a class="page-link ${active}" href="javascript: void(0);" onclick="loadTickets(${i})">${i}</a></li>`;
        }

        if (res.next_page_url) {
            pag += `<li class="page-item">
                        <a class="page-link" href="javascript: void(0);" onclick="loadTickets(${current + 1})" aria-label="Next">
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
            `;
        }

        pag += '</ul>';

        $('#paginacao').html(pag);
    }

    function deleteRow(){
        Swal.fire({
            title: 'Tem certeza que deseja realizar essa exclusão?',
            text: "Você não poderá reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
        
                $.ajax({
                    url: '/api/tickets/' + ticket_id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire(
                            'Exclusão Realizada!',
                            'O ticket foi excluído com sucesso.',
                            'success'
                        );

                        // Atualiza listagem
                        loadTickets();
                    },
                    error: function () {
                        Swal.fire(
                            'Erro!',
                            'Não foi possível excluir o ticket.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endpush
@endsection