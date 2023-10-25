from providers.HuggingFaceProvider import HuggingFaceProvider
from providers.FakeProvider import FakeProvider
from providers.OpenAIProvider import OpenAIProvider

class ProviderFactory:
    @staticmethod
    def from_model(model_name: str):
        if model_name == 'hf':
            return HuggingFaceProvider()
        elif model_name == 'openai':
            return OpenAIProvider()
        elif model_name == 'fake':
            return FakeProvider()
        else:
            raise ValueError(f'Unknown model provider: {model_name}')
