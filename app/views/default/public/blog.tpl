{include('header.tpl')}
	{if $records.error}
		{include('404.tpl')}
	{else}
		<title>Blog - {$system.name}</title>
		<main class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<h2>Blog</h2>
				</div>
				{loop $records}
					<div class="col-md-4 card">
						<h4>{$title}</h4>
						<p>{$details}</p>
					</div>
				{/loop}
			</div>
		</main>
	{/if}
{include('footer.tpl')}