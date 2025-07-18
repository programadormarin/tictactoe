# Product Overview

This is a Tic Tac Toe game API built as a web service. The application provides a REST API endpoint that accepts the current board state and player unit, then returns the computer's next move along with game status (winner/tied).

## Key Features
- Single API endpoint: `POST /api/move`
- Accepts JSON payload with `playerUnit` ("X" or "O") and `boardState` (3x3 array)
- Returns computer's next move, winner status, and tie status
- Simple random move strategy for computer opponent
- Web interface available at root URL

## API Usage
```json
POST /api/move
{
  "playerUnit": "X",
  "boardState": [
    ["X", "O", ""],
    ["X", "O", "O"],
    ["", "", ""]
  ]
}
```

Response includes `nextMove`, `winner`, and `tied` fields.