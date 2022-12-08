    {{-- create new post modal --}}
    <div class="modal fade" id="createNewPost" tabindex="-1" role="dialog" aria-labelledby="createNewPostLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="modal-title" id="createNewPostLabel">Creat a Post</h5>
                        </div>
                        <div class="col-lg-6">
                            <div class="toggle-switch">
                                <span>Share to your story</span>
                                <label class="switch">
                                    <input type="checkbox" name="is_story">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('client.create.new.event') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="my-password">Add a Title<span class="text-danger">*</span></label>
                            <input class="form-control input-group-lg" type="text" name="title" title="Add a Title"
                                placeholder="Add a Title" />
                        </div>
                        <div class="form-group">
                            <label for="my-password">Add a Description<span class="text-danger">*</span></label>
                            <input class="form-control input-group-lg" type="text" name="description"
                                title="Add a Description" placeholder="Add a Description" />
                        </div>
                        <div class="form-group">
                            <label for="my-password">Tag Friends</label> <br>
                            <select class="userSearch form-control p-3" name="friends[]" multiple="multiple"></select>
                            {{-- <input class="form-control input-group-lg" type="text" name="friends"
                                title="add @ Tag Friends" placeholder="add @ Tag Friends" id="friends-list" /> --}}
                        </div>
                        <div class="form-group">
                            <label for="my-password">Add #Tags</label>
                            <select class="tagSearch form-control p-3" name="tags[]" multiple="multiple"></select>
                        </div>
                        <div class="form-group">
                            <label for="my-password">Add Media<span class="text-danger">*</span></label>
                            <input class="form-control input-group-lg" type="file" name="images[]" title="Add Media"
                                placeholder="Add #Tags" multiple />
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="my-password">Add Ticket details<span
                                            class="text-danger">*</span></label>
                                    <div class="toggle-switch">
                                        <label class="switch" style="margin-top: -20px">
                                            <input type="checkbox" name="ticket_detail" id="detail-checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ticket-detail d-none">
                            <div class="form-group">
                                <label for="my-password">Ticket price({{ currency() }})<span
                                        class="text-danger">*</span></label>
                                <input class="form-control input-group-lg" type="number" name="ticket_price"
                                    title="Ticket price" placeholder="Ticket price ({{ currency() }})" />
                            </div>
                            <div class="form-group">
                                <label for="my-password">No. of Tickets <span class="text-danger">*</span></label>
                                <input class="form-control input-group-lg" type="number" name="total_tickets"
                                    title="No. of  Tickets" placeholder="No. of  Tickets" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">PUBLISH YOUR POST</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
