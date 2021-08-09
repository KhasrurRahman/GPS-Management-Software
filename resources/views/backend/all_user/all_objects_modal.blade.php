<style>
    nav>.nav.nav-tabs {

        border: none;
        color: #fff;
        background: #272e38;
        border-radius: 0;

    }

    nav>div a.nav-item.nav-link,
    nav>div a.nav-item.nav-link.active {
        border: none;
        padding: 5px 25px;
        color: #fff;
        background: green;
        border-radius: 0;
    }

    nav>div a.nav-item.nav-link.active:after {
        content: "";
        position: relative;
        bottom: -45px;
        left: -10%;
        border: 15px solid transparent;
        border-top-color: #e74c3c;
    }

    .tab-content {
        background: #fdfdfd;
        line-height: 25px;
        border: 1px solid #ddd;
        border-top: 5px solid #e74c3c;
        border-bottom: 5px solid #e74c3c;
        padding: 30px 25px;
    }

    nav>div a.nav-item.nav-link:hover,
    nav>div a.nav-item.nav-link:focus {
        border: none;
        background: #e74c3c;
        color: #fff;
        border-radius: 0;
        transition: background 0.20s linear;
    }

    .loader {
        text-align: center;
        vertical-align: middle;
        position: relative;
        display: flex;
        background: white;
        padding: 150px;
        box-shadow: 0px 40px 60px -20px rgba(0, 0, 0, 0.2);
    }

    .loader span {
        display: block;
        width: 20px;
        height: 20px;
        background: #eee;
        border-radius: 50%;
        margin: 0 5px;
        box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
    }

    .loader span:nth-child(2) {
        background: #f07e6e;
    }

    .loader span:nth-child(3) {
        background: #84cdfa;
    }

    .loader span:nth-child(4) {
        background: #5ad1cd;
    }

    .loader span:not(:last-child) {
        animation: animate 1.5s linear infinite;
    }

    @keyframes animate {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(30px);
        }
    }

    .loader span:last-child {
        animation: jump 1.5s ease-in-out infinite;
    }

    @keyframes jump {
        0% {
            transform: translate(0, 0);
        }

        10% {
            transform: translate(10px, -10px);
        }

        20% {
            transform: translate(20px, 10px);
        }

        30% {
            transform: translate(30px, -50px);
        }

        70% {
            transform: translate(-150px, -50px);
        }

        80% {
            transform: translate(-140px, 10px);
        }

        90% {
            transform: translate(-130px, -10px);
        }

        100% {
            transform: translate(-120px, 0);
        }
    }

    .lds-ellipsis {
        display: inline-block;
        position: relative;
        /* width: 10px; */
        height: 12px;
        right: 10%;
    }

    .lds-ellipsis div {
        position: absolute;
        top: 4px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #fff;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
    }

    .lds-ellipsis div:nth-child(1) {
        left: 8px;
        animation: lds-ellipsis1 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(2) {
        left: 8px;
        animation: lds-ellipsis2 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(3) {
        left: 32px;
        animation: lds-ellipsis2 0.6s infinite;
    }

    .lds-ellipsis div:nth-child(4) {
        left: 56px;
        animation: lds-ellipsis3 0.6s infinite;
    }

    @keyframes lds-ellipsis1 {
        0% {
            transform: scale(0);
        }

        100% {
            transform: scale(1);
        }
    }

    @keyframes lds-ellipsis3 {
        0% {
            transform: scale(1);
        }

        100% {
            transform: scale(0);
        }
    }

    @keyframes lds-ellipsis2 {
        0% {
            transform: translate(0, 0);
        }

        100% {
            transform: translate(24px, 0);
        }
    }

</style>

<div class="modal fade" id="all_object" tabindex="-1" role="dialog" aria-labelledby="all_objectLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="all_objectLabel">Users Objects</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="body_content">
                    <div class="row">
                        <div class="col-md-12 ">
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                        href="#nav-home" role="tab" aria-controls="nav-home"
                                        aria-selected="true">Active</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                        href="#nav-profile" role="tab" aria-controls="nav-profile"
                                        aria-selected="false">Inactive</a>
                                </div>
                            </nav>
                            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <form action="" id="active_object_form">
                                        <ul class="list-group" id="active_panel">

                                        </ul>
                                        <button type="submit" class="btn btn-danger btn-block active_button" id="active_button"></button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">
                                    <form action="" id="inactive_object_form">
                                        <ul class="list-group" id="inactive_panel">

                                        </ul>
                                        <button type="submit" class="btn btn-success btn-block active_button" id="inactive_button"></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
