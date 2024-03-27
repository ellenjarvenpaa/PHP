<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lorem Ipsum Generator</title>
<style>
  .result {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ccc;
  }
</style>
</head>
<body>
  <h2>Generate Lorem Ipsum Text</h2>
  <form method="post">
    <div>
      <label for="color">Color:</label><br>
      <input type="radio" id="red" name="color" value="red">
      <label for="red">Red</label>
      <input type="radio" id="green" name="color" value="green">
      <label for="green">Green</label>
      <input type="radio" id="blue" name="color" value="blue">
      <label for="blue">Blue</label>
    </div>
    <div>
      <label for="size">Size:</label><br>
      <select id="size" name="size">
        <option value="small">Small</option>
        <option value="medium">Medium</option>
        <option value="large">Large</option>
      </select>
    </div>
    <div>
      <label>Font Style:</label><br>
      <input type="checkbox" id="bold" name="style[]" value="bold">
      <label for="bold">Bold</label>
      <input type="checkbox" id="italic" name="style[]" value="italic">
      <label for="italic">Italic</label>
    </div>
    <button type="submit" name="submit">Generate Lorem Ipsum</button>
  </form>
  <div class="result">
    <?php
    if(isset($_POST['submit'])){
      $color = $_POST['color'] ?? 'black'; // Default color is black
      $size = $_POST['size'] ?? 'medium'; // Default size is medium
      $styles = $_POST['style'] ?? [];
      $fontStyle = '';

      // Generating font style
      if(in_array('bold', $styles)) {
        $fontStyle .= 'font-weight: bold; ';
      }
      if(in_array('italic', $styles)) {
        $fontStyle .= 'font-style: italic; ';
      }

      // Generating lorem ipsum text
      $loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec lectus nec magna blandit lobortis.';

      // Displaying lorem ipsum text with inline styles
      echo '<p style="color: ' . $color . '; font-size: ' . $size . '; ' . $fontStyle . '">' . $loremIpsum . '</p>';
    }
    ?>
  </div>
</body>
</html>

