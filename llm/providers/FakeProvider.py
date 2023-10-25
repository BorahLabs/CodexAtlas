from typing import List
from providers.AbstractProvider import AbstractProvider
from models.Message import Message

class FakeProvider(AbstractProvider):
    def __init__(self):
        super().__init__()

    def generate(self, messages: List[Message]) -> str:
        return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
