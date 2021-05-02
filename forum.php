<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="css/home_main.css" rel="stylesheet">
    <link href="forum.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
</head>

<body>
    <?php 
        include "navbar.php";
        include "php/forum_php/loadQuestions.php";
        $filter="";
        if(isset($_REQUEST["tag"]))
            $filter = $_REQUEST["tag"];
    
    ?>
    <script>changeActiveLink("forum-link");</script>
 

    <div class="container-fluid">
        <div class="main-body p-0">
            <div class="inner-wrapper">
                <!-- Inner sidebar -->
                <div class="inner-sidebar">
                    <!-- Inner sidebar header -->
                    <div class="inner-sidebar-header justify-content-center">
                        <a href="Post.php">
                                <button class="btn btn-primary has-icon btn-block" type="button" data-toggle="modal"
                                    data-target="#threadModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-plus mr-2">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    NEW DISCUSSIONs
                                </button>
                        </a>
                    </div>
                    <!-- /Inner sidebar header -->

                    <!-- Inner sidebar body -->
                    <div class="inner-sidebar-body p-0">
                        <div class="p-3 h-100" data-simplebar="init">
                            <div class="simplebar-wrapper" style="margin: -16px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper"
                                            style="height: 100%; overflow: hidden scroll;">
                                            <div class="simplebar-content" style="padding: 16px;">
                                                <nav class="nav nav-pills nav-gap-y-1 flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="nav-link nav-link-faded has-icon active">All Threads</a>
                                                    <a href="javascript:void(0)"
                                                        class="nav-link nav-link-faded has-icon">Popular this week</a>
                                                    <a href="javascript:void(0)"
                                                        class="nav-link nav-link-faded has-icon">Popular all time</a>
                                                    <a href="javascript:void(0)"
                                                        class="nav-link nav-link-faded has-icon">Solved</a>
                                                    <a href="javascript:void(0)"
                                                        class="nav-link nav-link-faded has-icon">Unsolved</a>
                                                    <a href="javascript:void(0)"
                                                        class="nav-link nav-link-faded has-icon">No replies yet</a>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 234px; height: 292px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 151px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Inner sidebar body -->
                </div>
                <!-- /Inner sidebar -->

                <!-- Inner main -->
                <div class="inner-main">
                    <!-- Inner main header -->
                    <div class="inner-main-header">
                        <a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#"
                            data-toggle="inner-sidebar"><i class="material-icons">arrow_forward_ios</i></a>
                        <select class="custom-select custom-select-sm w-auto mr-1">
                            <option selected="">Latest</option>
                            <option value="1">Popular</option>
                            <option value="3">Solved</option>
                            <option value="3">Unsolved</option>
                            <option value="3">No Replies Yet</option>
                        </select>
                        <span class="input-icon input-icon-sm ml-auto w-auto">
                            <input type="text"
                                class="form-control form-control-sm bg-gray-200 border-gray-200 shadow-none mb-4 mt-4"
                                placeholder="Search forum" />
                        </span>
                    </div>
                    <!-- /Inner main header -->

                    <!-- Inner main body -->


               
                    <!-- Forum List -->
                    <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                        <?php loadQuestions($filter)?>
                       
                        <ul class="pagination pagination-sm pagination-circle justify-content-center mb-0">
                            <li class="page-item disabled">
                                <span class="page-link has-icon"><i class="material-icons">chevron_left</i></span>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                            <li class="page-item active"><span class="page-link">2</span></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                            <li class="page-item">
                                <a class="page-link has-icon" href="javascript:void(0)"><i
                                        class="material-icons">chevron_right</i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /Forum List -->

                    <!-- /Inner main body -->
                    </div>
                <!-- /Inner main -->
            </div>

            <!-- New Thread Modal -->
            <div class="modal fade" id="threadModal" tabindex="-1" role="dialog" aria-labelledby="threadModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header d-flex align-items-center bg-primary text-white">
                                <h6 class="modal-title mb-0" id="threadModalLabel">New Discussion</h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="threadTitle">Title</label>
                                    <input type="text" class="form-control" id="threadTitle" placeholder="Enter title"
                                        autofocus="" />
                                </div>
                                <textarea class="form-control summernote" style="display: none;"></textarea>

                                <div class="custom-file form-control-sm mt-3" style="max-width: 300px;">
                                    <input type="file" class="custom-file-input" id="customFile" multiple="" />
                                    <label class="custom-file-label" for="customFile">Attachment</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="js/question_js/question.js"></script>
</body>

</html>