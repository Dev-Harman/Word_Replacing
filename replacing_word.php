<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    h1 {
        color: #333;
        margin-top: 20px;
    }

    form {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 20px auto;
    }

    input[type="text"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: block;
    }

    input[type="submit"] {
        background: #28a745;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background: #218838;
    }

    .output {
        background: #fff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 20px auto;
        text-align: left;
    }

    .output p {
        margin: 5px 0;
        font-size: 16px;
    }

    .highlight {
        color: #d9534f;
        font-weight: bold;
    }
    </style>

    <title>Replacing_Word</title>
</head>

<body>
    <h1>WORD FIND AND REPLACE</h1>
    <form action="./replacing_word.php" method="post">
        <input type="text" name="text" placeholder="Enter any Text">
        <input type="text" name="find" placeholder="Enter word to Find">
        <input type="text" name="replace" placeholder="Enter word to Replace">
        <input type="Submit" name="Submit">
    </form>
</body>

</html>
<?php
if (isset($_POST['Submit'])) {
    $unproper_paragraph = ($_POST['text']);
    $find_word = ($_POST['find']);
    $replaced_with = ($_POST['replace']);
    $found = 0;
    $find_word_lower = strtolower($find_word);
    $converted_to_array = explode(' ', $unproper_paragraph);
    // Iterate whole array
    foreach ($converted_to_array as $key => $word) {
        $last_char_save = substr($word, -1);
        if ($last_char_save == ',' || $last_char_save == '.') {
            $clean_word = strtolower(trim($word, '.,'));
            if ($clean_word == $find_word_lower) {
                echo 'Position of word ' . $find_word . ' : ' . $key . "\n";
?> <br><?php
                $converted_to_array[$key] = $replaced_with . $last_char_save;
                $found = 1;
            }
        } else {
            if (strtolower($word) == $find_word_lower) {
                echo 'Position of word ' . $find_word . ' : ' . $key . "\n";
?> <br><?php
                $converted_to_array[$key] = $replaced_with;
                $found = 1;
            }
        }
    }
    echo '<div class="output">';
    if ($found == 0) {
        echo '<p class="highlight">Not Found.............</p>';
    } else {
        echo '<p><strong>Unproper Paragraph:</strong> ' . htmlspecialchars($unproper_paragraph) . '</p>';
        echo '<p><strong>Proper Paragraph:</strong> ' . implode(' ', $converted_to_array) . '</p>';
        echo '<p><strong>Reversed Paragraph:</strong> ' . strrev(implode(' ', $converted_to_array)) . '</p>';
    }
    echo '</div>';
}
?>