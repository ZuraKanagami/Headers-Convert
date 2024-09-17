<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert Headers</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 900px;
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            letter-spacing: 1.5px;
        }

        .input-output {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        textarea {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 1rem;
            color: #fff;
            transition: all 0.3s ease-in-out;
            width: 100%;
            resize: none;
            height: 150px;
        }

        textarea:focus {
            background-color: rgba(255, 255, 255, 0.3);
            outline: none;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        button {
            background-color: #00d084;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 auto;
            display: block;
        }

        button:hover {
            background-color: #00a96b;
        }

        .output-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .formatted-json, .formatted-headers {
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 8px;
            color: #00ffab;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.9rem;
            overflow-x: auto;
            white-space: pre-wrap;
        }

        .output-title {
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
        }

        .double-column {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .column {
            width: 48%;
        }

        @media (max-width: 768px) {
            .double-column {
                flex-direction: column;
            }

            .column {
                width: 100%;
            }
        }
    </style>
    <script>
        function convertHeaders() {
            var headersInput = document.getElementById('headersInput').value;
            var headersArray = headersInput.split('\n');
            var formattedHeaders = {};
            var formattedHeadersString = 'headers = {\n';

            for (var i = 0; i < headersArray.length; i++) {
                var header = headersArray[i].trim();
                if (header !== '') {
                    var separatorIndex = header.indexOf(':');
                    if (separatorIndex > -1) {
                        var key = header.substring(0, separatorIndex).trim();
                        var value = header.substring(separatorIndex + 1).trim();
                        formattedHeaders[key] = value;
                        formattedHeadersString += `    "${key}": "${value}",\n`;
                    }
                }
            }

            formattedHeadersString = formattedHeadersString.slice(0, -2) + '\n}';

            document.getElementById('formattedJson').innerText = JSON.stringify(formattedHeaders, null, 4);
            document.getElementById('formattedHeaders').innerText = formattedHeadersString;
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Header Converter</h1>
        <div class="input-output">
            <textarea id="headersInput" placeholder="Paste your headers here..."></textarea>
            <button onclick="convertHeaders()">Convert Headers</button>
        </div>
        <div class="output-container">
            <div class="double-column">
                <div class="column">
                    <div class="output-title">Formatted JSON</div>
                    <pre class="formatted-json" id="formattedJson"></pre>
                </div>
                <div class="column">
                    <div class="output-title">Headers Object</div>
                    <pre class="formatted-headers" id="formattedHeaders"></pre>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
