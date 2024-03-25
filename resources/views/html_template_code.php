<!-- editMission Modal - start -->
<div class="modal fade" id="editMissionModal" tabindex="-1" role="dialog" aria-labelledby="editMissionModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-header">
                        <h3 class="card-title" id="editMissionModal">{{ __("Edit Mission") }}</h3>
                        <button class="btn btn-danger btn-sm window-close-btn" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-12">
                                {!! Form::open(['id' => 'editMission']) !!}
                                <div class="row form-content">
            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div style="float:right;">
                            <button type="button" class="btn btn-danger" style="margin-right: 2rem;" data-bs-dismiss="modal">{{ __("Close") }}</button>
                            <input class="btn btn-xs btn-primary" type="submit" value='{{ __("Send") }}'>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<script>
    $("#editMission").submit(function (event) {
        var formData = $(this).serialize();

        // console.log(formData);
        $.ajax({
            //todo
        });
    });
</script>
