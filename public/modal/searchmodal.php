<div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="container animated fadeIn p-t-100 p-b-100">
        <div class="e-container relationships-page" id="mainContainer">
            <div class="h2 e-brown m-t-0">Find Connections</div>
            <div class="m-b-10" type="text" placeholder="Type something to search..." >
                <input type="text" placeholder="Type something to search..." class="form-control" id="searchText">
            </div>
            <ul class="nav nav-pills nav-justified e-nav-pills">
                <li class="active" id="li-allTab">
                    <a class="e-brown pointer allTab" id="allTab">All</a>
                </li>
                <li id="li-relationshipTab">
                    <a class="e-brown pointer" id="relationshipTab">Relationships</a>
                </li>
                <li id="li-incomingTab">
                    <a class="e-brown pointer" id="incomingTab">Incoming</a>
                </li>
                <li id="li-outgoingTab">
                    <a class="e-brown pointer" id="outgoingTab">Outgoing</a>
                </li>
            </ul>
            <div class="users-section animated fadeIn">
                <div infinite-scroll="friendsLoader.nextPage()" >
                    <div class="m-t-15 search-divider e-brown p-l-10 animated fadeIn" id="myRelationships">My Relationships
                    </div>
                    <!--<h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="allTabShow">There are no relationships yet</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="incomingTabShow">There are no incoming relationships requests</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="outgoingTabshow">There are no outgoing relationships requests</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="relationshipTabShow">You have no relationships yet</h2>-->
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="relationshipTabShow"></h2>

                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab">
                        <span>Rajyasree</span>
                        <span>Das</span> has no relationships yet
                    </h2>
                    <div id="tabResults">
                    </div>
                </div>
                <div class="">
                    <div class="m-t-50 search-divider e-brown p-l-10" id="globalSearch" style="display:none;">Global search</div>
                    <div style="display:none;" id="loader">
                        <img src ="/image/loading.gif"/ style=" height: 160px; padding-left: 450px;">
                    </div>
                    <div id="searchResults">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
