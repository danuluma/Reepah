{include('header.tpl')}
    <title>Videos - {$system.name}</title>
    <main class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{capitalize $records.status} Videos</h4>
                  <p class="card-description">
                   Videos > <code>{$records.status}</code>
                  </p>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Genre</th>
                        <th>Author</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    {if $records.videos.error}
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-danger">No videos found</td>
                            <td></td>
                            <td> <i class="mdi mdi-pencil mdi-24px" style="color: red"></i></td>
                        </tr>
                      {else}
                        {loop $records.videos}
                            <tr>
                                <td>{$id}</td>
                                <td>{$title}</td>
                                <td>{$title}</td>
                                <td>{$title}</td>
                                <td>{$title}</td>
                                <td>{$title}</td>
                                <td> <i class="mdi mdi-delete mdi-24px" style="color: red"></i></td>
                            </tr>
                        {/loop}
                      {/if}
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
      </div>
    </main>
{include('footer.tpl')}
