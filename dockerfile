# Use Node.js official image
FROM node:20

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package*.json ./

# Install Node dependencies
RUN npm install

# Copy the rest of your frontend files (Vite entry points)
COPY . .

# Build the assets
RUN npm run build

# The built assets will be in public/build
# You can copy them back to your Laravel project or use a volume
