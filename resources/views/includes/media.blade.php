<div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">الوسائط</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xl-12">
                        <h6 class="text-muted"></h6>
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
                                        <i class='tf-icons bx bxs-category'></i>
                                        عرض الصور
                                        <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span>
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false">
                                        <i class='tf-icons bx bx-upload' ></i>
                                         رفع الصورة
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                                    <ul class="list-medias"></ul>
                                    <div class="footer-list-media text-center">
                                          <button type="button" class="btn btn-warning load-more-medias" >تحميل المزيد</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                                    <div class="btn-upload">
                                        <button class="btn btn-info btn-sm" style="position: relative">
                                            <input type="file" class="upload-image-inner" multiple/>
                                            <i class='bx bx-plus-circle' ></i>
                                            تحميل الميديا
                                        </button>
                                    </div>
                                    <div class="container-frame-upload-media">
                                        <ul class="list-upload-medias"></ul>
                                        {{-- <div class="upload-icon">
                                            <i class='bx bxs-cloud-upload' ></i>
                                        </div> --}}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                    الغاء
                </button>
                <button type="button" class="btn btn-primary select-media">تحديد الصورة</button>
            </div>
        </div>
    </div>
</div>