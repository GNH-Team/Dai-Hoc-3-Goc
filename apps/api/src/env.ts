// src/config/env.ts  
import dotenv from 'dotenv';  
import path from 'path';  
import { fileURLToPath } from 'url';  

const __filename = fileURLToPath(import.meta.url);  
const __dirname = path.dirname(__filename);  

export interface EnvConfig {  
  PORT: number;  
  DATABASE_URL: string;  
  API_KEY: string;  
  JWT_SECRET: string;  
  NODE_ENV: string;  
}  

export class EnvironmentConfig {  
  private config: EnvConfig;  

  constructor() {  
    this.config = this.loadEnvConfig();  
  }  

  private loadEnvConfig(): EnvConfig {  
    const env = process.env.NODE_ENV || 'development';  
    
    // Load environment specific .env file  
    dotenv.config({  
      path: path.resolve(__dirname, `../.env.${env}`)  
    });  

    // Load default .env file  
    dotenv.config({  
      path: path.resolve(__dirname, '../.env')  
    });  

    // Validate and transform environment variables  
    this.validateEnv();  

    return {  
      PORT: parseInt(process.env.PORT || '3000', 10),  
      DATABASE_URL: process.env.DATABASE_URL!,  
      API_KEY: process.env.API_KEY!,  
      JWT_SECRET: process.env.JWT_SECRET!,  
      NODE_ENV: env  
    };  
  }  

  private validateEnv(): void {  
    const requiredEnvVars = [  
      'PORT',  
      'DATABASE_URL',  
      'JWT_SECRET'  
    ];  

    const missingEnvVars = requiredEnvVars.filter(  
      (envVar) => !process.env[envVar]  
    );  

    if (missingEnvVars.length > 0) {  
      throw new Error(  
        `Missing required environment variables: ${missingEnvVars.join(', ')}`  
      );  
    }  
  }  

  public getConfig(): EnvConfig {  
    return this.config;  
  }  

  public get<K extends keyof EnvConfig>(key: K): EnvConfig[K] {  
    return this.config[key];  
  }  
}  

// Tạo singleton instance  
export const envConfig = new EnvironmentConfig();  
