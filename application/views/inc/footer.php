<script type="text/javascript">
	setInterval(function(){

		$.ajax({
            url: "<?= site_url('common/check_login_inactive_time/'); ?>",
            type: 'post',
            success: function (data) {
            	console.log(data);
            },
            error: function () {
            	
            }
        });

	}, 10000);
</script>
</body>
</html>