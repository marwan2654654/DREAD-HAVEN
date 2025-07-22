<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    if (isset($_POST['type']) && $_POST['type'] === 'message') {
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $message = strip_tags($_POST['message']);

        $entry = "Name: $name\nEmail: $email\nMessage:\n$message\n-------------------\n";
        file_put_contents('messages.txt', $entry, FILE_APPEND);
        echo json_encode(['status' => 'success']);
        exit();
    }

    if (isset($_POST['type']) && $_POST['type'] === 'book') {
        $file = 'bookings.txt';
        $count = file_exists($file) ? (int)file_get_contents($file) : 0;
        $count++;
        file_put_contents($file, $count);
        echo json_encode(['status' => 'success', 'count' => $count]);
        exit();
    }

    echo json_encode(['status' => 'error']);
    exit();
}


$booking_count = file_exists("bookings.txt") ? (int)file_get_contents("bookings.txt") : 0;
?>

<!DOCTYPE html>

<style>
  @font-face {
    font-family: 'myfont';
    src: url('shloprg.otf') format('opentype');
  }

  * {
    font-family: 'myfont', sans-serif;
    color: red;
  }

.all_p, .all_p *{
  font-family: Arial, sans-serif !important;
  color: #fff;
}

</style>


<html lang="en" style=" background-image: url('back.jpg'); background-size: 100% 100%;background-position: center; background-repeat: no-repeat;">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Glaxy Arts Studio</title>
  
  <link rel="stylesheet" href="sx.css" />
  <link rel="stylesheet" href="back.css" />

</head>
<body>

  <div class="all">
    <div class="f1">
      <div class="nave_bar">
        <img src="logo.png" alt="Logo" class="logo" />
        <h1 class="title" translate="no">Glaxy arts studio</h1>
      </div>
      <div class="all_p">
  <p>
    In an abandoned place shrouded in silence and darkness, <b>"Ellen"</b> awakens with no memory except her name. The hospital around her feels dead, but something moves in the shadows... distorted human-like creatures, victims of unethical experiments secretly conducted in this forgotten medical facility. <b>XENOVA Corp</b>, the entity behind this chaos, sought to control minds... ending the lives of all who passed through here—or reshaping them into something else.
  </p>
  <p>
    The story begins as a <b>cinematic solo experience filled with tension and psychological horror</b>, where you guide Ellen through the dark hospital, searching for a <b>lost past and hidden answers</b> behind locked doors and torn documents. With every step, she regains fragments of her memory... and gets closer to the <b>terrifying truth</b> of who she was and why she became the center of an inhuman experiment.
  </p>
  <p>
    In your journey, you will face:<br />
    - <b>Unique terrifying creatures</b>, like “The Patient’s Shadow,” “The Twisted Nurse,” and “The Hybrid Monster,” each with distinct behavior and survival mechanics.<br />
    - <b>Suffocating, detail-rich environments</b>, from old operating rooms to abandoned file archives, where danger lurks in every corner.<br />
    - <b>Psychological puzzles and layered storytelling</b> that gradually reveal the secrets of the hospital and XENOVA Corp, pushing you to question the nature of humanity and identity.
  </p>
  <p><b>But if you're looking for a multiplayer experience...</b></p>
  <p>
    A <b>completely separate co-op mode</b> has been designed, allowing you and your friends to enter the hospital as a group of survivors who found themselves trapped in this nightmare after the catastrophe. <b>This mode is not tied to the main story</b>, but offers independent challenges focused on teamwork, puzzle-solving, and surviving ever-changing threats.
  </p>
  <p>
    - <b>No single hero here</b>, just a whole team trying to survive in a merciless world.<br />
    - <b>Every session is different</b>, and every choice might be the line between life and death.
  </p>
  <p>
    <b>Whether you prefer diving into Ellen's deep story solo</b>, or facing the horror with your friends in a group experience, XENOVA Hospital awaits those bold enough to enter.
  </p>
  <p>
    <b>Do you have the courage to uncover what was meant to stay buried?</b><br />
    <b>Book now</b>, and start your journey inside one of the most immersive and thrilling horror worlds.
  </p>
  <a href="https://dread2haven.wuaze.com/">Dread Haven </a> © 2025 by <a href="mailto:studio.galaxyarts@gmail.com">Galaxy arts studio games </a> is licensed under <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY-NC-SA 4.0</a><img src="https://mirrors.creativecommons.org/presskit/icons/cc.svg" alt="" style="max-width: 1em;max-height:1em;margin-left: .2em;"><img src="https://mirrors.creativecommons.org/presskit/icons/by.svg" alt="" style="max-width: 1em;max-height:1em;margin-left: .2em;"><img src="https://mirrors.creativecommons.org/presskit/icons/nc.svg" alt="" style="max-width: 1em;max-height:1em;margin-left: .2em;"><img src="https://mirrors.creativecommons.org/presskit/icons/sa.svg" alt="" style="max-width: 1em;max-height:1em;margin-left: .2em;">

      </div>
    </div>

    <div class="f2">

      <div class="book-box f2a">
        <h2 id="booking-count"><?= $booking_count ?></h2>
        <h2 translate="no">Ready to face the horror?</h2>
        <button class="book-btn" id="book-btn" translate="no">Book now</button>
      </div>

 <div class="form-container f2b">
  <h2 translate="no">📩 Technical Support</h2>
  <form id="contact-form">
    <input type="text" name="name" id="name" placeholder="Your Name" required translate="no">
    <input type="email" name="email" id="email" placeholder="Your Email" required translate="no">
    <textarea name="message" id="message" rows="5" placeholder="Write your message here..." required translate="no"></textarea>
    <button type="submit" translate="no">Send</button>
  </form>
</div>

    </div>
  </div>

<script>

  document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    if (name && email && message) {
      fetch("", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
          type: "message",
          name: name,
          email: email,
          message: message
        })
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === "success") {
          document.getElementById("name").value = "";
          document.getElementById("email").value = "";
          document.getElementById("message").value = "";
        }
      });
    }
  });

  const bookBtn = document.getElementById('book-btn');
  if (localStorage.getItem("booked") === "true") {
    bookBtn.disabled = true;
    bookBtn.textContent = "Already booked";
  }

  bookBtn.addEventListener('click', function() {
    if (localStorage.getItem("booked") === "true") return;

    fetch("", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: new URLSearchParams({ type: "book" })
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === "success") {
        document.getElementById("booking-count").textContent = data.count;
        localStorage.setItem("booked", "true");
        bookBtn.disabled = true;
        bookBtn.textContent = "Already booked";
      }
    });
  });
</script>

<script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
<script>
  window.OneSignalDeferred = window.OneSignalDeferred || [];
  OneSignalDeferred.push(async function(OneSignal) {
    await OneSignal.init({
      appId: "61a16baf-7726-4d33-8e30-1315ab17a03d",
    });
  });
</script>

</body>
</html>
