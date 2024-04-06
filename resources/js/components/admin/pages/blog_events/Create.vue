<template>
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont-file-code bg-c-blue"></i>
                                <div class="d-inline my-2">
                                    <h4>Create Customer </h4>
                                    <!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-8 pl-3 pb-3 box-shadow mt-4">

                                <div action="" method="post" enctype="multipart/form-data">

                                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">New
                                        Article

                                        <a href="blog_events.php" class="btn btn-sm btn-danger float-right"
                                            style="font-size: 12px;"><i class="mdi mdi-close-circle mr-2"></i>
                                            Cancel</a>

                                        <button type="submit" name="submit"
                                            class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;"><i
                                                class="mdi mdi-account-plus mr-2"></i> Save article</button>

                                    </h4>

                                    <div class="form-group">
                                        <label for="booking_id">Wedding Type:</label>
                                        <select class="custom-select form-control" id="wedding_type"
                                            name="wedding_type">

                                            <option value="" selected>

                                            </option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="wedding_post">Related Wedding Post:</label>
                                        <select class="custom-select form-control" id="wedding_type"
                                            name="wedding_post">

                                            <option value="Select" selected>

                                            </option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                            placeholder="Enter article title">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea name="description" id="description" cols="30" rows="10"
                                            class="form-control"
                                            placeholder="Enter description and vendor of this wedding"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <input type="file" name="preview_image">

                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="wedding_date"
                                                data-provide="datepicker" id="wedding_date" placeholder="Wedding Date">
                                            <div class="input-group-append">
                                                <span class="input-group-text" style="background: white;">
                                                    <i style="color:#19b5bc;" class="mdi mdi-calendar-check" id="review"
                                                        aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control" id="location"
                                            placeholder="Enter Bride's Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="0">Draft</option>
                                            <option value="1">Publish</option>
                                        </select>
                                    </div>
                                </div><!-- end of input form -->
                            </div>
                            <div class="col-lg-3 mt-4">
                                <img id="preview_image" src="https://via.placeholder.com/350x350" width="300"
                                    height="350" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
