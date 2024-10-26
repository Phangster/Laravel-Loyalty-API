# ER Diagram for Membership Service

```mermaid
erDiagram
    USERS {
        UUID id
        VARCHAR name
        VARCHAR email
        VARCHAR password
        VARCHAR phone_number
        INT points_balance
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }
    
    REWARDS {
        UUID id
        VARCHAR name
        TEXT description
        INT points_required
        INT stock_quantity
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }
    
    POINTS_LEDGER {
        UUID id
        UUID user_id
        ENUM transaction_type
        INT points
        VARCHAR description
        TIMESTAMP created_at
    }

    REDEMPTIONS {
        UUID id
        UUID user_id
        UUID reward_id
        INT quantity
        INT points_spent
        TIMESTAMP redeemed_at
    }

    TRANSACTIONS {
        UUID id
        UUID user_id
        ENUM transaction_type
        DECIMAL transaction_amount
        INT points_earned
        TIMESTAMP created_at
    }

    MEMBERSHIP_TIER {
        UUID id
        VARCHAR name
        INT points_required
        DECIMAL discount_rate
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }

    USERS ||--o{ POINTS_LEDGER : "has"
    USERS ||--o{ REDEMPTIONS : "redeems"
    USERS ||--o{ TRANSACTIONS : "makes"
    REWARDS ||--o{ REDEMPTIONS : "is redeemed"
