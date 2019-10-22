<?php
	session_start();
	include_once './portal/config.php';
	include_once './portal/MyUser.class.php';
	include_once './portal/libs/NetID.class.php';

	if (! isset($_SESSION['Activity_ID']))
	{
		$netid = new NetID(HOSTDOMAIN, NETIDPREFIX, $netidAllowedRoles);

		$rc = $netid->doLogin($userid);

		if (is_object ($rc) and get_class ($rc) == 'NetIDReturn')
		{
			switch ($rc->returnCode)
			{
			case NetIDReturn::LOGIN_OK:
				require("./sql_link.php");
				$result = mysql_query("select * from administrator where Account='$rc->account'");
				$row = mysql_fetch_object($result);
                                $_SESSION["Activity_ID"] = $rc->account;
				if($row->OID != "")
				{
					//$_SESSION["Activity_ID"] = new MyUser($rc);
#					$_SESSION["Activity_ID"] = $rc->account;
					$_SESSION["Activity_admin"] = $row->Admin == 1 ? 1 : NULL;
					$_SESSION["Activity_post"] = $row->Post == 1 ? 1 : NULL;
					$_SESSION["Activity_Edit"] = $row->Activity_Edit;
					$_SESSION["Activity_Signup"] = $row->Activity_Signup;
					$_SESSION["Activity_Attend_rw"] = $row->Activity_Attend_rw;
					$_SESSION["Activity_Attend_r"] = $row->Activity_Attend_r;
					header("Location: ./index.php");
				}
				else
				{
					echo "<p align='center'>此帳號無管理者權限<br />";
					echo "<a href=javascript:history.back(1)>回上一頁</a></p>";
				}
				break;
				
			case NetIDReturn::LOGIN_FAILED:
				break;

			case NetIDReturn::CANCELED_AUTHENTICATION:
				echo "canceled";
				break;

			case NetIDReturn::ACCOUNT_NOT_ACCEPTABLE:
				echo "<p align='center'>此帳號不被接受<br />";
				echo "<a href=javascript:history.back(1)>回上一頁</a></p>";
				break;

			case NetIDReturn::ROLE_NOT_ACCEPTABLE:
				echo "<p align='center'>此帳號的角色不被本系統所接受<br />";
				echo "<a href=javascript:history.back(1)>回上一頁</a></p>";
				break;

			case NetIDReturn::ERROR_EXCEPTION:
			case NetIDReturn::REDIRECT_REQUEST:
				break;
			}
			return;
		}
	}

	header("location: ./index.php");

?>
