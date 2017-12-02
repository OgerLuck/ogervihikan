<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#4caf50">
        <link rel='shortcut icon' type='image/x-icon' href="{{ asset('img/favicon2.png') }}" />
        <title>Oger Vihikan</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('css/admin/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin//_all-skins.min.css') }}">

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
          <aside class="main-sidebar">
            <section class="sidebar">
              <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                  </ul>
                </li>
                <li class="treeview active">
                  <a href="#">
                    <i class="fa fa-edit"></i> <span>Posts</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="editors.html"><i class="fa fa-circle-o"></i> Create Post</a></li>
                    <li><a href="advanced.html"><i class="fa fa-circle-o"></i> Posts List</a></li>
                  </ul>
                </li>
                <li>
                  <a href="../widgets.html">
                    <i class="fa fa-th"></i> <span>Draft</span>
                  </a>
                </li>
                <li>
                  <a href="{{url('/signin/signout')}}">
                    <i class="fa fa-th"></i> <span>Sign Out</span>
                  </a>
                </li>
              </ul>
            </section>
          </aside>

          <div class="content-wrapper">
            <section class="content">
              <div class="row">
                <div class="col-md-12">
                  <div class="box box-info">
                    <div class="box-header">
                      <h3 class="box-title">Make a Blog Post
                      </h3>
                    </div>
                    <div class="box-body pad">
                      <form method ="POST" action="{{url('/blog/insert')}}">
                        <div class="form-group">
                          <input type="text" class="form-control" id="title" name="title" value="" placeholder="Title">
                        </div>
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <textarea id="editor1" name="content" rows="10" cols="80">         
                            </textarea>
                            <br>
                            <button class="btn btn-primary" type="submit">Post</button>
                      </form>
                    </div>
                  </div>
              </div>
            </section>
          </div>
          <footer class="main-footer">
            <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
            reserved.
          </footer>
        </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>

    <script>
      $(function () {
        tinymce.init({
          selector: 'textarea',
          height: 500,
          theme: 'modern',
          plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
          ],
          toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
          toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
          image_advtab: true,
          templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
          ],
          content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
          ]
         });
      });
    </script>
    </body>
</html>
