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
        <div class="row" style="padding-top: 30px;">
            <div class="col-md-6 card">
                <img class="card-img-top" src="images/faces/face1.jpg" alt="Card image cap">
            </div>
            <div class="col-md-6">
                <h2>Media Title</h2>
                <p>How it works
                Here’s what you need to know before getting started with the navbar:

                Navbars require a wrapping for responsive collapsing and color scheme classes.
                Navbars and their contents are fluid by default. Use optional containers to limit their horizontal width.
                Use our spacing and flex utility classes for controlling spacing and alignment within navbars.
                Navbars are responsive by default, but you can easily modify them to change that. Responsive behavior depends on our Collapse JavaScript plugin.
                Navbars are hidden by default when printing. Force them to be printed by adding .d-print to the .navbar. See the display utility class.
                Ensure accessibility by using a <nav> element or, if using a more generic element such as a <div>, add a role="navigation" to every navbar to explicitly identify it as a landmark region for users of assistive technologies.</p>
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