{include('header.tpl')}
  <title>Fees - {$system.name}</title>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        {if $session.utype == 'admin'}
        <div class="col-md-12">
                <div class="card" id="inner">
                    <img class="card-img-top btm" src="{$system.home}/app/assets/img/educ.svg">
                    <div class="card-block">
                          <h5 class="text-bold">Parking <span>Fee</span></h5>
                    </div>
                </div>
            </div>
       

	          <div class="col-xl-4 col-sm-6 mb-3">
	                <a href="{os_admin_url( 'parking/daily' )}" class="card rni">
	                    <!--<img class="card-img-top" src="images/lnds.png">-->
	                    <div class="card-block">
	                        <h5 class="txtclrd">Daily <span>Parking</span></h5>
	                    </div>
	                </a>
	            </div>

	        <div class="col-xl-4 col-sm-6 mb-3">
	              <div class="card rni">
	               <!--<img class="card-img-top" src="images/prmts.png">-->
	               <div class="card-block">
	                  <h5 class="txtclrd">Seasonal <span>Parking</span></h5>
	                </div>
	               </div>
	            </div>

            <div class="col-xl-4 col-sm-6 mb-3">
                <div class="card rni">
                    <!--<img class="card-img-top" src="images/util.png">-->
                    <div class="card-block">
                        <h5 class="txtclrd">Utilities</h5>
                    </div>
                </div>  
            </div>
        {else} {/if}       
      </div>
    </div>
  </div>
{include('footer.tpl')}
