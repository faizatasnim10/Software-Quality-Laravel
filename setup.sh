#!/bin/bash

echo "==============================================="
echo "   Starting Docker & Laravel (student-api)"
echo "==============================================="

# ----- 1. Check if Docker is running -----
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running."
    echo "➡️  Please start Docker Desktop manually."
    exit 1
fi

echo "✔ Docker is running."


# ----- 2. Navigate to project directory -----
PROJECT_PATH="/d/MS CSE/Software Quality/Upload HW/HW4_3/project-stage2-submission/code/student-api"

echo "Navigating to project: $PROJECT_PATH"
cd "$PROJECT_PATH" || {
    echo "❌ Project folder not found!"
    exit 1
}


# ----- 3. Start Docker containers -----
echo "Starting Laravel containers..."
docker compose up -d --build

if [ $? -ne 0 ]; then
    echo "❌ Failed to start containers."
    exit 1
fi


# ----- 4. Success message -----
echo "==============================================="
echo "   🎉 Laravel App Started Successfully!"
echo "   Your API is running at: http://localhost:8000"
echo "==============================================="

# ----- 5. Show container list -----
docker ps