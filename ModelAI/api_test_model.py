from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
import numpy as np
import joblib

# Initialiser l'app FastAPI
app = FastAPI(title="API de prédiction du cluster de diabète")

# Charger le modèle entraîné
model = joblib.load(r"C:\Users\saido\Desktop\Simplon\Brief4\diabeto-web\ModelAI\logistic_regression_best_model.pkl")

# Mapping cluster → risque
risk_mapping = {
    0: "Faible/Modéré",
    1: "Haut Risque",
    2: "Faible/Modéré",
    3: "Haut Risque",
    4: "Faible/Modéré"
}

# Définir le schéma de données avec Pydantic
class PatientFeatures(BaseModel):
    Glucose: float
    BMI: float
    Age: int
    DiabetesPedigreeFunction: float

# Route racine
@app.get("/")
def home():
    return {"message": "✅ API de prédiction de cluster de diabète prête."}

# Endpoint de prédiction
@app.post("/predict")
def predict(features: PatientFeatures):
    try:
        # Extraire les features dans l'ordre
        input_data = [
            features.Glucose,
            features.BMI,
            features.Age,
            features.DiabetesPedigreeFunction
        ]

        # Transformer en tableau NumPy
        input_array = np.array(input_data).reshape(1, -1)

        # Prédire le cluster
        cluster = model.predict(input_array)[0]
        risk = risk_mapping.get(cluster, "Inconnu")

        return {
            "cluster": int(cluster),
            "risk_category": risk
        }

    except Exception as e:
        raise HTTPException(status_code=400, detail=str(e))
