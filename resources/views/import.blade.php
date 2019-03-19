@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">CSV Import</div>
                    <p>This works only if the following columns are in this order</p>
                    <ul>
                        <li>Employee Id</li>
                        <li>First Name</li>
                        <li>Last Name</li>
                        <li>Title</li>
                        <li>Manager Id</li>
                    </ul>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('insert') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">CSV file to import</label>

                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control" name="file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" checked> File contains header row?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Parse CSV
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p>This sectional link is a demo showcassing if you place the file directly into the public folder with the name DATA.csv</p>
                        <a href="/demo">Demo</a>
                    </div>
                    <p>Bellow is the testing demo to make sure the journey can start</p>
                    <?php
                    echo "<tr>";
                    foreach ($FirstName as $user) {
                        echo"<td> $user->FirstName </td>";
                    }
                    echo "</tr>"
                    ?>
                </div>
            </div>
        </div>
    </div>
@endsection
