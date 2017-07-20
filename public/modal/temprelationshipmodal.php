<div class="modal fade" id="temprelationshipmodal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="container animated fadeIn p-t-100 p-b-100">
        <div class="e-container relationships-page" id="mainContainer">
            <div class="h2 e-brown m-t-0"><span class="firstName"></span>'s Connections</div>
            <div class="m-b-10" type="text" placeholder="Type something to search..." >
                <input type="text" placeholder="Type something to search..." class="form-control" id="searchTextTemp">
            </div>
            <div class="users-section animated fadeIn">
                <div infinite-scroll="friendsLoader.nextPage()" >
<!--
                    <div class="m-t-15 search-divider e-brown p-l-10 animated fadeIn" id="myRelationships">My Relationships
                    </div>
-->
                    <!--<h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="allTabShow">There are no relationships yet</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="incomingTabShow">There are no incoming relationships requests</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="outgoingTabshow">There are no outgoing relationships requests</h2>
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="relationshipTabShow">You have no relationships yet</h2>-->
                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTab" id="relationshipTabShow"></h2>

                    <h2 class="m-t-50 e-brown text-center animated fadeIn displayTabTemp">
                        <span></span>
                        <span id = "showTabMessageTemp"></span> 
                    </h2>
                    <div style="display:none;" id="loader">
                        <img src ="/image/loading.gif"/ style=" height: 160px; padding-left: 450px;">
                    </div>
                    <div id="tempResult">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
