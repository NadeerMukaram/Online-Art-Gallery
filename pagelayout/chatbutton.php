<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
  background-color: white;
  border-radius: 10px;
  max-width: 30rem;
  word-break: break-all;
}


/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>


	

<button class="open-button" onclick="toggleForm()" style="z-index: 9;">Chat</button>


<div class="chat-popup" id="myForm">
  <div style="margin:1rem">
  <form action="">
  <div class="separate">
    <h1 style="float: left;">Chat</h1>
    <button type="button" class="btn-dark cancel" onclick="toggleForm()" style="float: right;"><i class="fa-solid fa-square-xmark"></i></button>
  </div>


    <?php 
    include('publicchat.php');
    ?>		
		
    
  </form>
  </div>
</div>

<script>
  
  function toggleForm() {
    var chatPopup = document.getElementById("myForm");
    if (chatPopup.style.display === "none") {
      chatPopup.style.display = "block";
      scrollToLatestMessage(); // Scroll to the latest message when opening the chat pop-up
    } else {
      chatPopup.style.display = "none";
    }
  }
  

  // Function to scroll to the latest message
  function scrollToLatestMessage() {
    var chatbox = document.getElementById("chatbox");
    chatbox.scrollTop = chatbox.scrollHeight;
  }

  // Other code...
</script>