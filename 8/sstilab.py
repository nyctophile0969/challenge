from flask import Flask, request, render_template_string
import random

app = Flask(__name__)
app.config['FLAG'] = 'CTF{SSTI_vuln_flag_2024}'

# Array untuk random output
quotes = [
    "Hidup itu seperti kopi, terkadang pahit terkadang manis",
    "Belajar dari kesalahan adalah guru terbaik",
    "Jangan menyerah sebelum mencoba",
    "Kesuksesan datang dari kerja keras",
    "Waktu adalah uang, gunakan dengan bijak",
    "Mimpi adalah kunci untuk menggapai masa depan",
    "Keberanian adalah modal utama kesuksesan",
    "Kesabaran adalah kunci dari segala hal",
    "Hidup ini singkat, nikmati prosesnya",
    "Berpikir positif membawa hal positif"
]

@app.route("/")
def index():
    name = request.args.get('name', 'Tamu')
    # Pilih quote random
    random_quote = random.choice(quotes)
    
    template = '''
    <!DOCTYPE html>
    <html>
        <head>
            <title>Random Quote Generator</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 40px;
                    background-color: #f5f5f5;
                }
                .message {
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 8px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    margin-bottom: 20px;
                }
                .quote {
                    font-style: italic;
                    color: #666;
                    padding: 10px;
                    border-left: 4px solid #007bff;
                    margin: 10px 0;
                }
		.nb {
                    font-style: italic;
                    color: #666;
                    padding: 10px;
                    margin: 10px 0;
                }
                input[type="text"] {
                    padding: 8px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    width: 200px;
                }
                input[type="submit"] {
                    padding: 8px 16px;
                    background-color: #007bff;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }
                input[type="submit"]:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <h1>Random Quote Generator</h1>
            <div class="quote">
                kata kata gari ini bang '''+ name +''': ''' + random_quote + '''
            </div>
            <form method="GET">
                <input type="text" name="name" placeholder="Masukin nama kamu">
                <input type="submit" value="Generate">
            </form>
            <p class="nb">NB: ini code python, jangan macem macm tar di gigit, rawwrrr<p>
        </body>
    </html>
    '''
    return render_template_string(template)

if __name__ == "__main__":
    app.run(host='127.0.0.1', port=5000, debug=True)
