from enum import Enum
from typing import List
from pydantic import BaseModel

class Role(str, Enum):
    user = 'user'
    system = 'system'

class Message(BaseModel):
    role: Role
    content: str

class CompletionRequest(BaseModel):
    messages: List[Message]
