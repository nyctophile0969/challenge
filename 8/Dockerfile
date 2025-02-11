# Gunakan image Python resmi dari Docker Hub
FROM python:3.9-slim

# Set working directory di dalam container
WORKDIR /app

# Copy file requirements.txt ke working directory
COPY requirements.txt .

# Install dependencies
RUN pip install --no-cache-dir -r requirements.txt

# Copy seluruh kode aplikasi ke working directory
COPY . .

# Expose port 80
EXPOSE 80

# Command untuk menjalankan aplikasi Flask
CMD ["python", "app.py"]