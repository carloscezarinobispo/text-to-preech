<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text-to-Speech com ElevenLabs</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f2f5; }
        .container { background: white; padding: 2em; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; }
        textarea { width: 100%; height: 150px; margin-bottom: 1em; padding: 0.5em; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 0.75em 1.5em; border: none; background-color: #007bff; color: white; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .audio-player { margin-top: 1em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Text-to-Speech</h1>
        <p>Digite seu texto para convertê-lo em áudio usando a API da ElevenLabs.</p>
        
      
        <form id="tts-form" action="{{ route('audio.convert') }}" method="POST">
            @csrf
            <textarea name="text" id="text" placeholder="Digite seu texto aqui..."></textarea>
            <button type="submit">Converter para Áudio</button>
        </form>
        
        <div id="audio-container" class="audio-player" style="display: none;">
            <h3>Áudio gerado:</h3>
            <audio controls autoplay id="audio-element"></audio>
        </div>
        <div id="loading" style="display: none;">
            <p>Convertendo...</p>
        </div>
        <div id="error-message" style="color: red; margin-top: 1em; display: none;"></div>
    </div>

    <script>
        document.getElementById('tts-form').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const audioContainer = document.getElementById('audio-container');
            const audioElement = document.getElementById('audio-element');
            const loading = document.getElementById('loading');
            const errorMessage = document.getElementById('error-message');

            audioContainer.style.display = 'none';
            errorMessage.style.display = 'none';
            loading.style.display = 'block';

            try {
                const formData = new FormData(form);

                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'audio/mpeg',
                    }
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    try {
                        const errorData = JSON.parse(errorText);
                        throw new Error(errorData.error || 'Erro desconhecido');
                    } catch {
                        throw new Error('Ocorreu um erro no servidor. Verifique o console para mais detalhes.');
                    }
                }
                
                const audioBlob = await response.blob();
                const audioUrl = URL.createObjectURL(audioBlob);

                audioElement.src = audioUrl;
                audioContainer.style.display = 'block';

            } catch (error) {
                errorMessage.textContent = 'Erro: ' + error.message;
                errorMessage.style.display = 'block';
            } finally {
                loading.style.display = 'none';
            }
        });
    </script>
</body>
</html>
