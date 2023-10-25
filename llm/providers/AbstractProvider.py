import os
from typing import List
from models.Message import Message

class AbstractProvider:
    def generate(self, messages: List[Message]) -> str:
        raise NotImplementedError()

    def max_tokens(self) -> int:
        return int(os.getenv('MAX_TOKENS', 256))

    def temperature(self) -> float:
        return float(os.getenv('TEMPERATURE', 0.7))

    def top_k(self) -> int:
        return int(os.getenv('TOP_K', 50))

    def top_p(self) -> float:
        return float(os.getenv('TOP_P', 0.95))
