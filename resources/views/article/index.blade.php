@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="col-sm-offset-0 col-sm-6">
                    <button type="submit" class="btn btn-default" data-toggle="modal" data-target="#modalCreate">
                        <i class="fa fa-btn fa-plus"></i>Add article
                    </button>
                </div>
              </div>
            </div>

            <!-- Current Tasks -->
            @if (count($articles) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Articles list
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Article name</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td class="table-text"><div>{{ $article->name }}</div></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="...">
                                                <button type="button" id="viewArticle" data-id="{{ $article->id }}" class="btn btn-default"  data-toggle="modal" data-target="#modalView"><i class="glyphicon glyphicon-eye-open"></i></button>
                                                <button type="button" id="updateArticle" data-id="{{ $article->id }}" class="btn btn-default" data-toggle="modal" data-target="#modalUpdate"><i class="glyphicon glyphicon-pencil"></i></button>
                                                <button type="button" id="deleteArticle" data-id="{{ $article->id }}" class="btn btn-default" data-toggle="modal" data-target="#modalDelete"><i class="glyphicon glyphicon-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Modal -->
            <div class="modal" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="modalCreate">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new article</h4>
                  </div>
                  <div class="modal-body">
                    <form action="{{ url('article') }}" method="POST" class="form-horizontal" id="formCreate">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="article-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Category</label>

                            <div class="col-sm-6">
                                <select name="category" id="article-category" class="selectpicker col-sm-12">
                                    @foreach ($categories as $category)
                                        <option value='{{$category->id}}'>{{$category->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Text</label>
                            <div class="col-sm-6">
                                <textarea type="text" name="text" id="article-text" class="form-control" value="{{ old('task') }}"></textarea>
                            </div>
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnCreate">Create</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdate">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new article</h4>
                  </div>
                  <div class="modal-body">
                    <form action="{{ url('article') }}" method="POST" class="form-horizontal" id="formUpdate">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" id="article-id" class="form-control" value="">
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Name</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="article-name" class="form-control" value="{{ old('task') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Category</label>

                            <div class="col-sm-6">
                                <select name="category" id="article-category" class="selectpicker col-sm-12">
                                    @foreach ($categories as $category)
                                        <option value='{{$category->id}}'>{{$category->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Text</label>
                            <div class="col-sm-6">
                                <textarea type="text" name="text" id="article-text" class="form-control" value="{{ old('task') }}"></textarea>
                            </div>
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnUpdate">Update</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalView">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View</h4>
                  </div>
                  <div class="modal-body">
                        <p><b>Id:</b> <span id="view-id"></span></p>
                        <p><b>Category:</b> <span id="view-category"></span></p>
                        <p><b>Name:</b> <span id="view-name"></span></p>
                        <p><b>Text:</b> <span id="view-text"></span></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDelete">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View</h4>
                  </div>
                  <div class="modal-body">
                        <form action="{{ url('article') }}" method="POST" class="form-horizontal" id="formDelete">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="id" id="article-id" class="form-control" value="">
                        </form>
                        <p>Are you sure to delete this item?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btnDelete">Delete</button>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>
    <script src="js/script_article.js"></script>
@endsection
