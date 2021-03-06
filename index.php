<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require_once('common.php') ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>C++ Boilerplate Generator</title>
  <script type="text/javascript" src=
  "https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
</script>
  <script src="ICanHaz.min.js" type="text/javascript">
</script>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
  <script id="checkboxsection" type="text/html">
    <div id="checkbox_panel">
      <input type="checkbox" checked="true">Use spiffy javascript interface</input>
    </div>
  </script>
  <script id="downloadsection" type="text/html">
    <div id="download_panel">
      <h2>Download Links</h2>
      <ul id="download_links"></ul>
      <button id="redo">Start Over</button>
    </div>
  </script>
  <script id="downloadlink" type="text/html">
    <li><a href="download.php?{{ query_string }}&ext={{ ext }}">Click to download the .{{ ext }} file</a></li>
  </script>
  <script type="text/javascript">
//<![CDATA[
      // when the dom's ready
      $(document).ready(function () {
        //$("#container").prepend(ich.checkboxsection({}));

        var dlsection;
        dlsection = ich.downloadsection({});
        dlsection.hide();
        $('#container').append(dlsection);
        $('#redo').click(function() {
          $('#download_panel').fadeOut();
          $('#formsection').fadeIn();
        });

        // add a simple click handler for the "submit" button.
        $('form').submit(function () {
          if ($('input:text').val() === "") {
            // Need something there!
            $('input:text').after("<em>File base name is required.<\/em>");
            $('input:text').focus(function () {
              $(this).next().fadeOut();
            });
            return false;
          }
          /*
          alert($('input:checkbox').val());
          if (! $('input:checkbox').val()) {
            // do the normal stuff.
            return true;
          }
          */

          var linkdata, linkitem;
          linkdata = {
            query_string: $(this).serialize()
          }

          // Empty the output to make way for us.
          $('#download_links').empty();

          linkdata["ext"] = "cpp";
          $('#download_links').append(ich.downloadlink(linkdata));

          linkdata["ext"] = "h";
          $('#download_links').append(ich.downloadlink(linkdata));

          linkdata["ext"] = "ch";
          $('#download_links').append(ich.downloadlink(linkdata));

          $('#formsection').slideUp();
          $('#download_panel').slideDown();
          // Don't actually want to submit the normal way now.
          return false;
        });
      });
  //]]>
  </script>
</head>

<body>
  <h1><img src="favicon_48.png" style="float:right;"/>C++ Boilerplate Generator</h1>

  <div id="container">
    <div id="formsection">
      <h2>Input Data</h2>

      <form action="family.php" method="get">
        <p>
          <label for="filebase">Base of filename (no extension):</label><br/>
          <input type="text" name="filebase" />
        </p>

        <p>
          <label for="authorlines">Your author information:</label><br/>
          <textarea name="authorlines" rows="6" cols="60"><?php print(htmlspecialchars($defaults['author'])); ?></textarea>
        </p><input type="submit" />
      </form>
    </div>
  </div>
  <p>Get the source code to this app and make it better: <a href="https://github.com/rpavlik/generate-cpp-boilerplate">generate-cpp-boilerplate on GitHub</a></p>
</body>
</html>
