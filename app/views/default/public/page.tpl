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
                <div class="row">
                    <div class="col-md-6">
                        <audio controls="">
                        <source src="{$system.home}/app/assets/music/john.mp3" type="audio/mpeg"></audio>
                    </div>
                    <div class="col-md-6"> 
                        <i class="mdi mdi-music-note-whole mdi-24px" style="padding-left: 40px;"></i> <a href="{os_home_url('lyrics/23')}">Subtitles/Lyrics</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2>{$records.title}</h2>
                {$records.details}
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <p><a href="{os_home_url('artist/elani')}" class="mdi mdi-account mdi-24px"> Artist Profile</a> </p>
                    </div>
                    <form class="col-md-8">
                        <div class="form-group row">
                          <label class="col-sm-5 col-form-label">Premium content</label>
                          <div class="col-sm-4">
                            <select class="form-control">
                              <option>Pay via</option>
                              <option>Mpesa</option>
                              <option>Credit card</option>
                            </select>
                          </div>
                          <div class="col-sm-3"><input type="submit" class="btn btn-primary" value="BUY"></div>
                        </div>
                    </form>
                </div>
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
                <img class="card-img-top" src="https://placeimg.com/640/480/people?t=1524993014487" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="https://placeimg.com/640/480/people?t=1524993014487" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="https://placeimg.com/640/480/people?t=1524993014487" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="https://placeimg.com/640/480/people?t=1524993014487" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="https://placeimg.com/640/480/people?t=1524993014487" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
            <div class="col-md-2 card text-center">
                <img class="card-img-top" src="https://placeimg.com/640/480/people?t=1524993014487" alt="Card image cap">
                <a href="#" class="card-title" style="top: -40px; position: relative; color: lightgreen"><b>Media Main title</b></a>
            </div>
        </div>
    {/if}
  </div>
{include('footer.tpl')}