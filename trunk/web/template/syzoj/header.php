<?php 
	$url=basename($_SERVER['REQUEST_URI']);
	$dir=basename(getcwd());
	if($dir=="discuss3") $path_fix="../";
	else $path_fix="";
 	if(isset($OJ_NEED_LOGIN)&&$OJ_NEED_LOGIN&&(
                  $url!='loginpage.php'&&
                  $url!='lostpassword.php'&&
                  $url!='lostpassword2.php'&&
                  $url!='registerpage.php'
                  ) && !isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
 
           header("location:".$path_fix."loginpage.php");
           exit();
        }

	if($OJ_ONLINE){
		require_once($path_fix.'include/online.php');
		$on = new online();
	}
?>

<!DOCTYPE html>
<html lang="cn" style="position: fixed; width: 100%; overflow: hidden; ">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=1200">
    <title><?php echo $show_title ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php");?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
</head>

<body style="position: relative; margin-top: 49px; height: calc(100% - 49px); overflow-y: overlay; ">
    <div class="ui fixed borderless menu" style="position: fixed; height: 49px; ">
        <div class="ui container">
            <a class="header item" href="/"><span
                    style="font-family: 'Exo 2'; font-size: 1.5em; font-weight: 600; "><?php echo $OJ_NAME?></span></a>
	    <a class="item <?php if ($url=="") echo "active";?>" href="/"><i class="home icon"></i> <?php echo $MSG_HOME?></a>
            <a class="item <?php if ($url=="problemset.php") echo "active";?>"
                href="<?php echo $path_fix?>problemset.php"><i class="list icon"></i><?php echo $MSG_PROBLEMS?> </a>
            <a class="item <?php if ($url=="category.php") echo "active";?>"
                href="<?php echo $path_fix?>category.php"><i class="globe icon"></i><?php echo $MSG_SOURCE?></a>
            <a class="item <?php if ($url=="contest.php") echo "active";?>" href="<?php echo $path_fix?>contest.php"><i
                    class="calendar icon"></i> <?php echo $MSG_CONTEST?></a>
            <a class="item <?php if ($url=="status.php") echo "active";?>" href="<?php echo $path_fix?>status.php"><i
                    class="tasks icon"></i><?php echo $MSG_STATUS?></a>
            <a class="item <?php if ($url=="ranklist.php") echo "active";?>"
                href="<?php echo $path_fix?>ranklist.php"><i class="signal icon"></i> <?php echo $MSG_RANKLIST?></a>
            <!--<a class="item <?php //if ($url=="contest.php") echo "active";?>" href="/discussion/global"><i class="comments icon"></i> 讨论</a>-->
            <a class="item <?php if ($url=="faqs.php") echo "active";?>" href="<?php echo $path_fix?>faqs.php"><i
                    class="help circle icon"></i> <?php echo $MSG_FAQ?></a>

            <?php if(isset($_GET['cid'])){
            	$cid=intval($_GET['cid']);
            ?>
            <a id="back_to_contest" class="item active" href="<?php echo $path_fix?>contest.php?cid=<?php echo $cid?>" ><i
                    class="arrow left icon"></i><?php echo $MSG_CONTEST.$MSG_PROBLEMS.$MSG_LIST?></a>
            <?php }?>
            <div class="right menu">
                <?php if(isset($_SESSION[$OJ_NAME.'_'.'user_id'])) { ?>
                <a href="<?php echo $path_fix?>/userinfo.php?user=<?php echo $_SESSION[$OJ_NAME.'_'.'user_id']?>"
                    style="color: inherit; ">
                    <div class="ui simple dropdown item">
                        <?php echo $_SESSION[$OJ_NAME.'_'.'user_id']; ?>
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="<?php echo $path_fix?>modifypage.php"><i
                                    class="edit icon"></i>修改资料</a>
                            <?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){ ?>
                            <a class="item" href="<?php echo $path_fix ?>/admin"><i class="settings icon"></i>后台管理</a>
                            <?php } ?>
                            <a class="item" href="<?php echo $path_fix?>/logout.php"><i class="power icon"></i>注销</a>
                        </div>
                    </div>
                </a>
                <?php } else { ?>


                <div class="item">
                    <a class="ui button" style="margin-right: 0.5em; " href="<?php echo $path_fix?>/loginpage.php">
                       <?php echo $MSG_LOGIN?> 
                    </a>
                    <?php if(isset($OJ_REGISTER)&&$OJ_REGISTER ){ ?>
                    <a class="ui primary button" href="<?php echo $path_fix?>/registerpage.php">
                       <?php echo $MSG_REGISTER?> 
                    </a>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div style="margin-top: 28px; ">
        <div class="ui main container">
