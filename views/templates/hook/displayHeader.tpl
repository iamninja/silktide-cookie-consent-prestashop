{if $active}
	link_more
	{$link_more}
	<script>
	    window.cookieconsent_options = {
	    	message: "{$message}",
	    	dismiss: "{$dismiss}",
	    	learnMore: "{$learn_more}",
	    	link: "{$link_more}",
	    	theme: "{$theme}",
	    	expiryDays: {$expiry_days}
	    }
	</script>
	<script type="text/javascript" src="//s3.amazonaws.com/cc.silktide.com/cookieconsent.latest.min.js"></script>
{/if}