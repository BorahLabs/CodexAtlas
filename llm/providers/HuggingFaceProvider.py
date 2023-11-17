import torch
import os
from transformers import pipeline
from typing import List
from providers.AbstractProvider import AbstractProvider
from models.Message import Message


class HuggingFaceProvider(AbstractProvider):
    def __init__(self):
        super().__init__()
        self.pipe = pipeline(
            "text-generation",
            model=os.getenv('MODEL_NAME'),
            device_map="auto"
        )

    def generate(self, messages: List[Message]) -> str:
        prompt = self.pipe.tokenizer.apply_chat_template(
            messages, tokenize=False, add_generation_prompt=True)
        outputs = self.pipe(
            prompt,
            max_new_tokens=self.max_tokens(),
            do_sample=True,
            temperature=self.temperature(),
            top_k=self.top_k(),
            top_p=self.top_p()
        )
        return outputs[0]["generated_text"]
