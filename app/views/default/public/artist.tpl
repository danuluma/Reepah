{include('header.tpl')}
{include('nav.tpl')}
	<div class="container">
    <style type="text/css">
      .card-title {
        top: -40px; position: relative; color: lightgreen
      }

      h1, .h1 {
        font-size: 5.1rem;
      }
    </style>
    {if $records.error}
        {include('404.tpl')}
    {else}
        <title>{$records.title} - {$system.name}</title>
        <div class="row" style="padding-top: 30px;">
            <div class="col-md-6 card">
                <img class="card-img-top" src="{$records.avatar}" alt="Card image cap">
                <hr>
            </div>
            <div class="col-md-6">
                <h2>{$records.title}</h2>
                {$records.details}
                <br><br>
                <p><i class="mdi mdi-phone mdi-24px"></i> <span>0705459494</span> </p>
                <p> </p>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <br>
                <h2>Related Artists</h2>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="http://res.cloudinary.com/dxzxetu4a/image/upload/v1525001553/sage.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Sage </b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="http://res.cloudinary.com/dxzxetu4a/image/upload/v1525001514/elani.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Elani</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="http://res.cloudinary.com/dxzxetu4a/image/upload/v1525001514/timmytdat.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Timmy Tdat</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="http://res.cloudinary.com/dxzxetu4a/image/upload/v1525001514/kingkaka.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>King Kaka</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="http://res.cloudinary.com/dxzxetu4a/image/upload/v1525001574/juacali.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Jua cali</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="https://placeimg.com/640/480/people?t=1524993014487" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
        </div>
    {/if}
  </div>
{include('footer.tpl')}