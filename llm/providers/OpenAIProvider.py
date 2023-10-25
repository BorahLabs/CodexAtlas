import openai, os
from typing import List
from providers.AbstractProvider import AbstractProvider
from models.Message import Message

class OpenAIProvider(AbstractProvider):
    def __init__(self):
        super().__init__()
        openai.api_key = os.getenv('OPENAI_API_KEY')

    def generate(self, messages: List[Message]) -> str:
        messages = [message.model_dump() for message in messages]
        completion = openai.ChatCompletion.create(
            model=os.getenv('MODEL_NAME', 'gpt-3.5-turbo'),
            messages=messages,
            max_tokens=self.max_tokens(),
            temperature=self.temperature(),
            top_p=self.top_p(),
        )
        return completion.choices[0].message.content
