<div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="container animated fadeIn p-t-100 p-b-100">
        <div class="e-container relationships-page">
            <div class="h2 e-brown m-t-0">Find Connections</div>
            <div class="m-b-10" type="text" placeholder="Type something to search..." >
                <input type="text" placeholder="Type something to search..." class="form-control">
            </div>
            <ul class="nav nav-pills nav-justified e-nav-pills">
                <li class="active">
                    <a class="e-brown pointer" id="allTab">All</a>
                </li>
                <li>
                    <a class="e-brown pointer" id="relationshipTab">Relationships</a>
                </li>
                <li>
                    <a class="e-brown pointer" id="incomingTab">Incoming</a>
                </li>
                <li>
                    <a class="e-brown pointer" id="outgoingTab">Outgoing</a>
                </li>
            </ul>
            <div class="users-section animated fadeIn">
                <div infinite-scroll="friendsLoader.nextPage()" >
                    <div class="m-t-15 search-divider e-brown p-l-10 animated fadeIn">My Relationships
                    </div>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="allTabShow">There are no relationships yet</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="incomingTabShow">There are no incoming relationships requests</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="outgoingTabshow">There are no outgoing relationships requests</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="relationshipTabShow">You have no relationships yet</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab">
                        <span>Rajyasree</span>
                        <span>Das</span> has no relationships yet
                    </h2>
                </div>
                <div class="">
                    <div class="m-t-50 search-divider e-brown p-l-10">Global search</div>
                    <div class="user-field m-t-25 animated fadeIn">
                        <div class="media">
                            <div class="media-left media-middle">
                                <img class="media-object user-img" >
                            </div>
                            <div class="media-body media-middle">
                                <h3 class="m-t-0">
                                    <a class="e-brown e-link" >
                                        <span class="">shilpita Chatterjee</span>
                                    </a>
                                </h3>
                            </div>
                            <div class="media-right media-middle btn-section">
                                <div class="relationship-btn" user="client" >
                                    <button class="btn e-btn btn-warning full">
                                        <div class="fa fa-clock-o"></div> Request sent
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="user-field m-t-25 animated fadeIn">
                            <div class="media">
                                <div class="media-left media-middle">
                                    <img class="media-object user-img" >
                                </div>
                                <div class="media-body media-middle">
                                    <h3 class="m-t-0">
                                        <a ui-sref="app.user.show({user_id: client.id})" class="e-brown e-link" href="/users/61/profile">
                                            <span class="">shilpita chatterjee</span>
                                        </a>
                                    </h3>
                                </div>
                                <div class="media-right media-middle btn-section">
                                    <div class="relationship-btn" >
                                        <button class="btn e-btn btn-info">
                                            <div class="fa fa-plus"></div> Connect
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
