<div class="card mb-3">
    <a class="collapsed" data-bs-toggle="collapse" data-bs-parent="#accordion3" href="#collapseTwo3" style="text-decoration: none" aria-expanded="false" aria-controls="collapseTwo3">
        <div class="card-header p-2" role="tab" id="headingTwo3">
            <h5 class="mb-0 text">
                Appearance
            </h5>
        </div>
    </a>
    <div id="collapseTwo3" class="collapse" role="tabpanel" aria-labelledby="headingTwo3">
        <div class="card-block px-2">
            <div class="row p-2">
                <form action="{{ route('settings.appearance') }}" method="POST">
                        @csrf
                        <input type="hidden" id="mode" value="" name="mode">
                    <div class="row">
                        <div class=" col-md-4 mb-4" onclick="webTheme('dark')" >
                            <div class="card card-mode text-white card-has-bg click-col" id="card-dark" style="background-image:url({{ asset('images/darkmode.png') }});">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body">
                                    </div>
                                    <div class="card-footer">
                                        <div class="media">
                                            <div class="media-body">
                                                <h6 class="my-0 d-block" style="color: red">
                                                    Dark Mode
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4" onclick="webTheme('light')">
                            <div class="card card-mode text-white card-has-bg click-col" id="card-light" style="background:url({{ asset('images/lightmode.png') }})">
                                <div class="card-img-overlay d-flex flex-column">
                                    <div class="card-body">
                                    </div>
                                    <div class="card-footer">
                                        <div class="media">
                                            <div class="media-body">
                                                <h6 class="my-0 d-block" style="color: red">
                                                    Light Mode
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success float-end p-1">
                        Save
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
