<?php
if (isset($_SESSION['messages'])) {
    echo '<div class="messages">';
    foreach ($_SESSION['messages'] as $message) {
        echo '<ul>';
            echo '<li class="' . htmlspecialchars($message['type']). 'Message">' .
                        htmlspecialchars($message['text']) . '</li>';
        echo '</ul>';
    }
    echo '</div>';
    unset($_SESSION['messages']);
}
