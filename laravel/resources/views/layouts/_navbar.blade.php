<div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    
                </div>
            </form>
        </div>
           


            <ul class="nav navbar-top-links navbar-right">
                @if(Auth::user()->punyaAkses())    
                <li class="dropdown" id="lnotif">
                </li>

                @endif
                <li>
                    <a onclick="logout()">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>

        <script type="text/javascript">
            function statusNotif(id) {
                
            }
            function lihatSemua() {
                
            }

        </script>