<!--
   AUTHOR: Asadullah Nadeem 
    VERSION: 1.0.0 
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">
  <div class="min-h-screen flex">

    <!-- Main Content -->
    <main class="flex-1 p-4">
      <div class="w-full bg-white shadow-lg rounded-lg p-6">
        <table class="w-full table-auto border-collapse border border-gray-300">
          <thead>
            <tr class="bg-gray-200 border-b">
              <th class="text-left px-4 py-2 border-r">Name</th>
              <th class="text-left px-4 py-2 border-r">Last Modified</th>
              <th class="text-left px-4 py-2">Size</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Define the directory
            $directory = '.';

            // Files or directories to exclude
            $excludedFiles = ['index.php', 'info.php', 'phpmyadmin', 'logs.txt', 'read_logs.php', 'write_log.php'];

            // Scan the directory
            $files = scandir($directory);

            // Loop through files and directories
            foreach ($files as $file) {
              if ($file !== '.' && $file !== '..' && !in_array($file, $excludedFiles)) {
                $filePath = $directory . DIRECTORY_SEPARATOR . $file;
                $lastModified = date("Y-m-d H:i:s", filemtime($filePath));
                $size = is_dir($filePath) ? '-' : filesize($filePath) . ' bytes';

                echo "<tr class='hover:bg-gray-100 border-b'>
            <td class='px-4 py-2 border-r'><a href='{$file}' class='text-blue-500 underline'>"
                  . (is_dir($filePath) ? '📁' : '📄')
                  . "{$file}</a></td>
            <td class='px-4 py-2 border-r'>{$lastModified}</td>
            <td class='px-4 py-2'>{$size}</td>
          </tr>";
              }
            }
            ?>

          </tbody>
        </table>
      </div>
    </main>

    <!-- Log Viewer -->
    <aside class="w-1/3 bg-white shadow-lg p-4 overflow-y-auto">
      <h2 class="text-lg font-bold mb-4">Real-Time Logs</h2>
      <div id="log-container" class="bg-gray-100 h-full overflow-y-scroll p-4 rounded">
        <p>Loading logs...</p>
      </div>
    </aside>
  </div>

  <footer class="bg-gray-200 text-gray-600 text-center py-4 text-sm">
    <div>
      Powered by Apache/2.4.58 (Ubuntu) | Asadullah Nadeem
    </div>
    <div id="version-info" class="mt-2 text-gray-500">
      Loading version info...
    </div>
  </footer>

  <script>
    // Function to fetch and display logs
    async function fetchLogs() {
      try {
        const response = await fetch('read_logs.php');
        const logs = await response.text();

        // Check if logs indicate an error
        if (logs.includes('Error')) {
          document.getElementById('log-container').innerHTML = `<p class="text-red-500">${logs}</p>`;
        } else {
          document.getElementById('log-container').innerHTML = `<pre>${logs}</pre>`;
        }
      } catch (error) {
        document.getElementById('log-container').innerHTML = '<p class="text-red-500">Error fetching logs.</p>';
      }
    }

    // Fetch logs every 3 seconds
    setInterval(fetchLogs, 3000);
    fetchLogs();


    // Fetch and display PHP and MySQL versions
    async function fetchVersionInfo() {
      try {
        const response = await fetch('info.php');
        const data = await response.json();

        const versionInfo = `
        PHP Version: ${data.php_version} | MySQL Version: ${data.mysql_version}
      `;
        document.getElementById('version-info').innerText = versionInfo;
      } catch (error) {
        document.getElementById('version-info').innerText = 'Error loading version info.';
      }
    }

    // Fetch version info on page load
    fetchVersionInfo();
  </script>

</body>

</html>