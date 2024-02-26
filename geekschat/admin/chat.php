<?php 
	include('../functions.php');

	if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
	}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>GeeksChat</title>
	<link rel="stylesheet" href="../assets/framework/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/framework/fontawesome/v5.0.10/css/all.css">	
	<link rel="stylesheet" href="../assets/css/chat.css">
	<link rel="stylesheet" href="../assets/css/chat-adapter-bootstrap-4.css">
	
	<link rel="icon" type="image/ico" href="../assets/images/favicon.ico" />


 <style>
        /* Default styles for the search box */
        #chat-search .search-box {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 5px;
            display: flex;
            align-items: center;
            max-width: 100%;
            margin: 0 auto;
        }

        #chat-search .search-query {
            flex: 1;
            border: none;
            padding: 10px;
            font-size: 16px;
            background-color: transparent;
            outline: none;
            border-radius: 20px;
        }

        #chat-search .btn {
            background-color: green;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #chat-search .btn:hover {
            background-color: #128c7e;
        }

        .btn:hover {
            background-color: #128c7e;
        }

       /* Responsive styles */
@media (max-width: 768px) {
    #chat-search .search-query {
        padding: 5px;
        font-size: 14px;
        vertical-align: middle; /* Align text vertically in the middle */
    }

    #chat-search .btn {
        padding: 8px 16px;
        vertical-align: middle; /* Align button vertically in the middle */
    }
}

/* Additional styles for 902 x 775 */
@media (min-width: 769px) and (max-width: 902px) {
    #chat-search .search-query {
        padding: 5px;
        font-size: 10px;
        vertical-align: middle; /* Align text vertically in the middle */
    }

    #chat-search .btn {
        padding: 8px 15px;
        vertical-align: middle; /* Align button vertically in the middle */
    }
}

		
    </style>

</head>

<body class="chat-body">
	
	<div class="container-fluid" id="main-container">
		<div class="chat-row h-100">
		
			<div class="col-xs-12 col-sm-5 col-md-4 d-flex flex-column" id="chat-list-area" style="position:relative;">
				<!-- Navbar Left-->
				
				<div class="chat-row d-flex flex-row align-items-center p-2" id="navbar">
					<img alt="Profile Photo" class="img-fluid rounded-circle mx-2 mr-2" style="height:50px; cursor:pointer;" onclick="showProfileSettings()" id="display-pic">
					            <div class="text-black font-weight-bold"   style="color: grey; " id="username"><Strong><?php echo $username; ?></strong></div>

					<div class="text-black font-weight-bold" id="username" style="display:none"></div>					
					<div class="d-flex flex-row align-items-center ml-auto">
						<form method="POST" action="#" id="find_all">
   						 <button type="submit"  style="border: none; background: none; cursor: pointer;">
      				         <i class="fas fa-envelope mx-3 text-muted d-none d-md-block"></i>
    				     </button>
					</form>
						<span onclick="confirmLogout(); return false;" ><i class="fas fa-power-off mx-3 text-muted d-none d-md-block"></i></span>

    
						<div class="nav-item dropdown ml-auto">
						    <span class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
						        <i class="fas fa-ellipsis-v text-muted"></i>
						    </span>
						    <ul class="dropdown-menu dropdown-menu-right">
							    <li>
								    <a class="dropdown-item" href="#" onclick="checkNewMessage()" id="check-message" style="color:white; background-color:#337ab7">Check new message</a>
							        <!-- <a class="dropdown-item" href="#">New Group</a>
							        <a class="dropdown-item" href="#">Archived</a>
							        <a class="dropdown-item" href="#">Starred</a> -->
									<a class="dropdown-item" href="#">Settings</a>
								<a class="dropdown-item" href="home.php">Back Home</a>
							        <a class="dropdown-item" onclick="confirmLogout(); return false;"  style="color:red;">Log Out</a>
								</li>
						    </ul>
					    </div>
					</div>
				</div>
				<div id="chat-search" class="chat-row p-2" style="border-bottom: 1px solid #dadbdb;">
				

				<!-- serch box -->
					<div class="search-box">
						
        <form method="POST" action="search_users.php" id="search-form">
        <input type="text" name="search_username" value="<?php echo isset($search_username) ? $search_username : ''; ?>" placeholder="find a geek here!" class="search-query border-0" id="search-username">
        <input type="submit" class="btn" name="search_btn" value="Search" id="search_btn">
          </form>
          </div>
				</div>
				<!-- Chat List -->
				<div class="chat-row" id="chat-list" style="overflow:auto;"></div>
				
				<!-- Profile Settings -->
				<div class="d-flex flex-column w-100 h-100" id="profile-settings" style="z-index:2">
					<div class="chat-row d-flex flex-row align-items-center p-2 m-0" style="background:#009688; min-height:65px;">
						<i class="fas fa-arrow-left p-2 mx-3 my-1 text-white" style="font-size: 24px; cursor: pointer;" onclick="hideProfileSettings()"></i>
						<div class="text-white font-weight-bold">Geek's Profile</div>
					</div>
					<div class="d-flex flex-column" style="overflow:auto;">
						<img alt="Profile Photo" class="img-fluid rounded-circle my-5 justify-self-center mx-auto" id="profile-pic">
						<input type="file" id="profile-pic-input" class="d-none">
						<div class="bg-white px-3 py-2">
							<div class="text-muted mb-2"><label for="input-name">Your Name</label></div>
							<input type="text" name="name" id="input-name" class="w-100 border-0 py-2 profile-input">
						</div>
						<div class="text-muted p-3 small">
							This is not your username. This name will be visible to your Geeks' contacts.
						</div>
						<div class="bg-white px-3 py-2">
							<div class="text-muted mb-2"><label for="input-about">About</label></div>
							<input type="text" name="name" id="input-about" value="" class="w-100 border-0 py-2 profile-input">
						</div>
					</div>
				</div>				
			</div>
			
			<!-- Message Area -->
			<div class="d-none d-sm-flex flex-column col-xs-12 col-sm-7 col-md-8 p-0 h-100" id="message-area">
				<div class="w-100 h-100 overlay"  style="background-image:url('homeBK.png');background-size:cover;background-position:center;opacity: 0.9;"   id="b4Chatting"></div>
				<!-- Navbar Right-->
				<div class="chat-row d-flex flex-row align-items-center p-2 m-0 w-100" id="navbar" style="border-bottom: 1px solid #d7d0ca;">
					<div class="d-block d-sm-none">
						<i class="fas fa-arrow-left p-2 mr-2 text-white" style="font-size: 24px; cursor: pointer;" onclick="showChatList()"></i>
					</div>
					<a href="#"><img src="" alt="Profile Photo" class="img-fluid rounded-circle mx-2 mr-2" style="height:50px;" id="pic"></a>
					<div class="d-flex flex-column">
						<div class="text-black font-weight-bold-apagar" id="name"></div>
						<div class="text-black small" id="details" style="color: rgba(0, 0, 0, 0.6);"></div>
					</div>
					<div class="d-flex flex-row align-items-center ml-auto">
						<a href="#"><i class="fas fa-search mx-3 text-muted d-none d-md-block"></i></a>
						<a href="#"><i class="fas fa-paperclip mx-3 text-muted d-none d-md-block"></i></a>
						<a href="#"><i class="fas fa-ellipsis-v mr-2 mx-sm-3 text-muted"></i></a>
					</div>
				</div>
				<!-- Messages -->
				<div class="d-flex flex-column messages-bg" id="messages"></div>

				<!-- Input -->
				<div class="d-none justify-self-end align-items-center flex-row" id="input-area">
					<i class="far fa-smile text-muted px-4" style="font-size:24px; cursor:pointer;"></i>
					<input type="text" name="message" id="input" placeholder="Type a geek message here..." class="flex-grow-1 border-0 px-3 py-2 my-3 rounded-20 -shadow-sm; word-wrap: break-word;">
					<i class="fas fa-paper-plane text-muted px-4" style="cursor:pointer;" onclick="sendMessage()"></i>
				</div>
			</div>
			
		</div>
	</div>

	<script src="../assets/framework/jquery/jquery.min.js?ver=2.2.4"></script>
	<script src="assets/js/jquery-3.3.1.slim.min.js"></script>
	<script src="../assets/js/popper.min.js"></script>
	<script src="../assets/framework/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="../assets/js/datastore.js"></script>
	<script src="../assets/js/date-utils.js"></script>
	<script src="../assets/js/script.js"></script>

	<script src="../assets/framework/jquery/jquery.min.js?ver=2.2.4"></script>

<script>
$(document).ready(function() {
  // Target the search form by its ID
  $("#search-form").submit(function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    
    // Serialize the form data
    var formData = $(this).serialize();

    // Make an AJAX request to your PHP script
    $.ajax({
      type: "POST",
      url: "search_users.php", // Adjust the URL to your PHP script
      data: formData,
      success: function(response) {
		
        // Update the chat-list div with the search results
        $("#chat-list").html(response);
      },
      error: function() {
        alert("Error occurred while processing your request.");
      }
    });
  });
});

function confirmLogout() {
    var confirmLogout = confirm("Are you sure you want to log out?");
    if (confirmLogout) {
        // If the user clicks OK in the confirmation dialog, redirect them to login.php.
          window.location.replace("../login.php");
    } else {
        // If the user clicks Cancel, nothing happens, and they stay on the current page.
        
    }
}
</script>


</body>

</html>
