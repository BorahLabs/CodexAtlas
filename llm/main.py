import os, sys
from models.Message import CompletionRequest
from providers.Factory import ProviderFactory
from fastapi import FastAPI
from dotenv import load_dotenv

sys.path.append(".")

load_dotenv(override=True)

provider = ProviderFactory.from_model(os.getenv('MODEL_PROVIDER', 'fake'))

app = FastAPI()

@app.get('/api/status')
def status():
    return {
        'status': 'ok'
    }

@app.post('/api/generate')
def generate(body: CompletionRequest):
    output = provider.generate(body.messages)
    return {
        'output': output,
    }
