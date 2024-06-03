<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $_page }}</title>
    <style>
        @media print {
            @page {
                margin: 0.5in; /* Narrower margins */
            }

            body {
                margin: 0;
                padding-top: 80px; /* Space for header */
                padding-bottom: 50px; /* Space for footer */
            }

            header, footer {
                position: fixed;
                left: 0;
                right: 0;
                background-color: #f1f1f1;
                padding: 10px;
                text-align: center;
            }

            header {
                top: 0;
                border-bottom: 2px solid #ccc;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            header .app-details {
              display: flex;
              justify-content: space-between;
              align-items: center;
            }

            header .app-details img, header .app-details h3 {
              margin: 0;
            }

            footer {
                bottom: 0;
                border-top: 2px solid #ccc;
                display: flex;
                justify-content: space-between;
                align-items: center;
                columns: 6;
            }
            footer p {
              margin: 5px 0;
            }

            footer::after {
                content: 'Page ' counter(page);
                counter-increment: page;
                position: absolute;
                right: 10px;
                color: #ccc;
            }


            main {
                text-align: center; /* Center text within the main content */
            }

            .no-print {
                display: none;
            }

            .app-logo {
                max-height: 30px; /* Adjust based on your needs */
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

        }
    </style>
</head>
<body>
    <header>
        <div class="app-details"><h3> Document Tracking & Management System</h3></div>
        <div id="date-container"></div>
    </header>

    <main>
      <h2>{{ $title }}</h2>
      <p>{{ $description }}</p>

      <table>
          <thead>
              <tr>
                @foreach($tableData[0] as $header)
                    <th>{{ $header }}</th>
                @endforeach
              </tr>
          </thead>
          <tbody>
           @for($i = 1; $i < count($tableData); $i++)
                <tr>
                    @foreach($tableData[$i] as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endfor
          </tbody>
      </table>
    </main>

    <footer>
        <p></p>
    </footer>

    <script>
        var dateContainer = document.getElementById('date-container');
        var currentDate = new Date();
        var options = { month: 'long', day: 'numeric', year: 'numeric' };
        var formattedDate = currentDate.toLocaleDateString('en-US', options);
        dateContainer.textContent = formattedDate;
    </script>
</body>
</html>
