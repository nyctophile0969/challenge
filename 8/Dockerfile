# Gunakan image base Python 3.9
FROM python:3.9-slim

# Set working directory di dalam container
WORKDIR /app

# Copy file requirements.txt (jika ada)
# COPY requirements.txt .

# Install dependencies
RUN pip install flask

# Copy seluruh kode aplikasi ke working directory
COPY . .

# Expose port 5000 untuk Flask
EXPOSE 5000

# Jalankan aplikasi Flask
CMD ["python", "app.py"]