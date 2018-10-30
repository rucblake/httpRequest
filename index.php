<?php 
//url，默认使用上一次的
$url_file = dirname(__FILE__)."/url";
if (file_exists($url_file)) {
	$url = file_get_contents($url_file);
} else {
	$url = '';
}

//fields，默认使用上一次的
$fields_file = dirname(__FILE__)."/fields";
if (file_exists($fields_file)) {
	$fields = file_get_contents($fields_file);
} else {
	$fields = '';
}

//cookie，默认使用上一次的
$cookie_file = dirname(__FILE__)."/cookies";
if (file_exists($cookie_file)) {
	$cookie = file_get_contents($cookie_file);
} else {
	$cookie = '';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>httpRequest 本地测试工具</title>
		<link rel="stylesheet" href="dep/bootstrap.min.css" />
		<link rel="stylesheet" href="dep/jquery.jsonview.css" />
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<div class="container">
			<h1 class="text-center">httpRequest 本地测试工具</h1>
			<div class="row clearfix">
				<div class="col-md-6 column">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							 <label for="request-type" class="col-sm-2 control-label">type</label>
							<div class="col-sm-4">
								<select id="request-type" name="type" class="form-control">
									<option value="POST">POST</option>
									<option value="GET">GET</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							 <label for="request-url" class="col-sm-2 control-label">url</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="request-url" value="<?php echo $url; ?>" />
								<p class="tips">url默认使用上次的</p>
							</div>
						</div>
						<div class="form-group">
							 <label for="request-origin" class="col-sm-2 control-label">origin</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="request-origin" value="https://www.baidu.com"/>
							</div>
						</div>
						<div class="form-group">
							 <label for="request-referer" class="col-sm-2 control-label">referer</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="request-referer" value="https://www.baidu.com"/>
							</div>
						</div>
						<div class="form-group">
							 <label for="request-cookie" class="col-sm-2 control-label">cookie</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="request-cookie" rows='3' ><?php echo $cookie; ?></textarea>
								<p class="tips">cookie默认使用上次的</p>
							</div>
						</div>
						<div class="form-group">
							 <label for="request-fields" class="col-sm-2 control-label">fields</label>
							<div class="col-sm-10">
								<textarea class="form-control" id="request-fields" rows='3'><?php echo $fields; ?></textarea>
								<p class="tips">fields默认使用上次的</p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								 <a class="btn btn-default submit-request">go</a>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6 column">
					<div class="showJsonData"></div>
				</div>
			</div>
		</div>
		<script src="dep/jquery-3.1.0.min.js"></script>
		<script src="dep/jquery.jsonview.js"></script>
		<script>
			$('.submit-request').click(function(){
				var requestData = {
					type : $('#request-type').val(),
					url : $('#request-url').val(),
					origin : $('#request-origin').val(),
					referer : $('#request-referer').val(),
					cookies : $('#request-cookie').val(),
					fields : $('#request-fields').val(),
				}
				$.ajax({
					type : "post",
					url : "request.php",
					async : true,
					data : requestData,
					success : function(result){
						var jsonData = result;
						var data;
						try{
							var data = JSON.parse(jsonData);
							$('.showJsonData').JSONView(data);
						}catch(e){
							$('.showJsonData').text(jsonData);
						}
				        
					},
					error : function(result){
						alert(result);
					}
				});
			})
		</script>
	</body>
</html>
