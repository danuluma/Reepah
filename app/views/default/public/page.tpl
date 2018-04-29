{os_style( 'kube.css', 'local' )}
{include('header.tpl')}
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
                <img class="card-img-top" src="images/faces/face1.jpg" alt="Card image cap">
            </div>
            <div class="col-md-6">
                <h2>{$records.title}</h2>
                {$records.details}
                <br><br>
                <p><i class="mdi mdi-phone mdi-24px"></i> <span>0705459494</span> </p>
                <p><i class="mdi mdi-music-note-whole mdi-24px"></i> <a href="{os_home_url('lyrics/23')}">Subtitles/Lyrics</a> </p>
                <audio controls=""></audio>
            </div>
        </div>
        <div class="row">
            <div class="col-md-11">
                <br>
                <h2>Related Content</h2>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="images/faces/face1.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="images/faces/face1.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="images/faces/face1.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="images/faces/face1.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="images/faces/face1.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="images/faces/face1.jpg" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
        </div>
    {/if}
  </div>
{include('footer.tpl')}