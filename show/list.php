<!DOCTYPE html>
<html>
<head>
	<title>Bilibili</title>
	<script type="text/javascript" src="./show/jquery1.11.js"></script>
	<script type="text/javascript" src="./show/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="./show/bootstrap/css/bootstrap.min.css"/>
	<style type="text/css">
		body{
			
		    /*padding-top: 70px;*/
		    /*background:url('bk.jpg') 60% 100%  no-repeat fixed;*/
		}
		body:before {
		  content: ' ';
		  position: fixed;
		  z-index: -1;
		  top: 0;
		  right: 0;
		  bottom: 0;
		  left: 0;
		  background: url('./show/bk1.jpg') center 0 no-repeat;
		  background-size: 150% 120%;
		}
		.emphasize{
			color:#FEA208;
			font-size: 16px;
		}
		.c_selected{
			background: #31b0d5;
    		color: #fff !important;
		}
	</style>
</head>
<body>
<div class="page-header" style='height: 180px;background-image: url("//i0.hdslb.com/bfs/archive/00669f9c9a312204b6221e94892c5c268f6d8225.png@.webp")'>
  <!-- <h1>Example page header <small>Subtext for header</small></h1> -->
</div>
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="/bilibili">Bilibili<?php echo $catename ? ':'.$catename:''?></a>
		    </div>
			
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
		        <li><a href="/bilibili">首页</a></li>
		        <li class="dropdown sort_d">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $sort_info[1]?> <span class="caret"></span></a>
		          <?php echo $sort_html?>
		        </li>
		      </ul>

		      <!-- <form class="navbar-form navbar-left search_name navbar-right">
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Search" value="<?php echo $name?>">
		        </div>
		        <button type="submit" class="btn btn-default">Submit</button>
		      </form> -->
		      
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	<div class="container-fluid" style="width: 80%">
		<?php echo $nav_cate?>

		<table class="table " style="width: 100% !important;"><!-- table-striped table-bordered -->
			<?php $i = 0;while(isset($list[$i])):?>
				<tr>
					<?php $j=0;while($j<2):$v=$list[$i];if(!$v) break;?>
					<td width="15%" height="40px">
						<a href="javascript:;" target="_blank" data-toggle="modal" data-target="#myModal" class="play" aid="<?php echo $v['aid']?>">
							<img class="img-thumbnail" style="width: 160px !important;height:100px !important;margin-top: 10px" src="<?php echo 'http://'.$v['pic']?>"/>
						</a>
					</td>
					<td width="35%">
						<h4><a style="color:gray" class="play" href="javascript:;" aid="<?php echo $v['aid']?>" data-toggle="modal" data-target="#myModal" target="_blank"><!-- ./show/play.php?aid=<?php echo $v['aid']?> -->
						<?php echo $v['title'].(isset($v['catename']) ? '&nbsp;&nbsp;   ('.$v['catename'].')' : '')?></a></h4>
						<?php echo $v['author']?>/
						<?php echo $v['senddate'] ? $v['senddate'].'/' : ''?>
						<p>
							<span <?php if($sort_info[1]=='播放') echo 'class="emphasize"'?>>播放:<?php echo $v['play']?>&emsp;</span>
							<span <?php if($sort_info[1]=='收藏') echo 'class="emphasize"'?>>收藏:<?php echo $v['favorites']?></span>&emsp;
							<span <?php if($sort_info[1]=='评论') echo 'class="emphasize"'?>>评论:<?php echo $v['review']?></span>
						</p>
						<p style="padding-right: 50px;"><?php echo $v['intro']?></p>
					</td>
					<?php $i++;$j++;endwhile;?>
				</tr>
			<?php endwhile;?>
		</table>
		<!-- margin-left:877.5px -->
		<!-- <div style="position:fixed;margin-left:60%;max-width:400px;height:auto;filter:alpha(Opacity=80);-moz-opacity:0.4;opacity: 0.4;">
			<div class="btn-group" role="group" aria-label="...">
				<?php foreach($cates as $k=>$v):?>
					<button type="button" class="btn btn-default pick_cate <?php if($k == $cate) echo 'btn-info'?> " cate_id="<?php echo $k?>"><?php echo $v?></button>
				<?php endforeach;?>
			</div>
		</div> -->
		<div style="clear: left"></div>
		<?php echo $page?>
	</div>

	
	<!-- Button trigger modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg" role="document" style="width: 100%;">
	    <div class="modal-content" style="top:-30px">
	      <div class="modal-header" style="padding:0;">
	        <button type="button" class="close" data-dismiss="modal" style="margin-right: 10px" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      </div>
	      <div class="modal-body" style="padding:0">
	        
	      </div>
	    </div>
	  </div>
	</div>
</body>
<script type="text/javascript">
$(function(){
	$('.pick_cate').unbind('click').bind('click',function(){
		var cate_id = $(this).attr('cate_id');
		window.location.href = "/bilibili/index.php?cate="+cate_id+"&sort=<?php echo $sort?>";
	})
	$('.search_name').find('button').unbind('click').bind('click',function(){
		var form = $('.search_name');
		var event = event || window.event;
		event.preventDefault(); // 兼容标准浏览器
		window.event.returnValue = false; // 兼容IE6~8
		search_name(form);
	})

	$('.search_name').find('input').unbind('keydown').bind('keydown',function(){
		if(event.keyCode == 13)
			search_name($('.search_name'));
	})

	$('.sort_d').find('ul li a').bind('click',function(){
		var v = $(this).attr('v');
		href = window.location.href;
		if(href.indexOf('?') > 0){
			href += '&sort='+v;
		}else{
			href += '?sort='+v;
		}
		window.location.href = href;
	});
	function search_name(form){
		var name = $(form).find('input').val();
		if(name.length > 0)
			window.location.href = "/bilibili/search.php?name="+name;
	}
	var height = window.screen.height;
	$('.modal-lg').css({height:height+"px"})
	$('.modal-content').css({height:height+50+"px"})
	
	$('.play').each(function(){
		$(this).unbind('click').bind('click',function(){
			var aid = $(this).attr('aid')
			
			$('.modal-body').html("<iframe style='width:100%;height:100%' id='biiframe' src='http://www.bilibili.com/blackboard/player.html?aid="+aid+"&page='></iframe>");
			
			// frame.document.open();
			// biiframe.document.location.reload()
			// $.get('./show/play.php',{aid:aid},function(data){
				// console.log(data)
				
				// frame.document.write(data)
				// $('.modal-body iframe').append(data)
			// });
			$('.modal-body iframe').css({height:height+"px"})
			$('#myModal').on('hidden.bs.modal', function (e) {
			  $('.modal-body').html("")
			})
		})
	});
})
</script>
</html>