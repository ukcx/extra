`timescale 1ns / 1ps
//////////////////////////////////////////////////////////////////////////////////
// Company: 
// Engineer: 
// 
// Create Date: 12/21/2021 05:09:41 PM
// Design Name: 
// Module Name: phone_call
// Project Name: 
// Target Devices: 
// Tool Versions: 
// Description: 
// 
// Dependencies: 
// 
// Revision:
// Revision 0.01 - File Created
// Additional Comments:
// 
//////////////////////////////////////////////////////////////////////////////////
module tel (input clk,
        input rst,
        input startCall, answerCall,
        input endCall,
        input sendChar,
        input [7:0] charSent,
        output reg [63:0] statusMsg,
        output reg [63:0] sentMsg
);

parameter IDLE = 0;
parameter BUSY = 1;
parameter REJECTED = 2;
parameter RINGING = 3;
parameter CALL = 4;
parameter COST = 5;

reg [2:0] curr_state, next_state;
reg [4:0] counter;
reg [31:0] cost;

// sequential part - state transitions
always @ (posedge clk or posedge rst)
begin
    if(rst)
        counter <= 0;
    else
    if(curr_state == RINGING | curr_state == REJECTED | curr_state == BUSY | curr_state == COST)begin
        if(counter == 10)
            counter <= 0;
        else
            counter <= counter + 1;
    end 
        else
            counter <= counter;
end

// sequential part - control registers
always @ (posedge clk or posedge rst)
begin
    if(rst)
        curr_state <= 0;
    else
        curr_state <= next_state;
end

// combinational part - next state definitions
always @ (*) begin
    case(curr_state)
        IDLE:begin
            if(startCall == 1)
                next_state = RINGING;
            else
                next_state = IDLE;
        end
        RINGING:begin
            if(endCall == 1)
                begin
                    next_state = REJECTED;
                    counter = 0;
                end
            else if(answerCall == 1)
                begin
                    next_state = CALL;
                    counter = 0;
                end
            else if(counter == 10)
                next_state = BUSY;   
            else 
                next_state = RINGING;   
        end
        BUSY:begin
            if(counter == 10)
                next_state = IDLE;
            else
                next_state = BUSY;
        end
        REJECTED:begin
            if(counter == 10)
                next_state = IDLE;
            else
                next_state = REJECTED;
        end
        CALL:begin
            if(endCall == 1)
                next_state = COST;
            else if(charSent == 127)
                next_state = COST;
            else
                next_state = CALL;
        end
        COST:begin
            if(counter == 5)
                begin
                    next_state = IDLE;
                    counter = 0;
                end
            else
                next_state = COST;
        end
    endcase
end

// sequential part - outputs
always @ (posedge clk or posedge rst)begin
    if(rst)begin
        statusMsg <= 0;
        sentMsg[7:0] <= " ";
        sentMsg[15:8] <= " ";
        sentMsg[23:16] <= " ";
        sentMsg[31:24] <= " ";
        sentMsg[39:32] <= " ";
        sentMsg[47:40] <= " ";
        sentMsg[55:48] <= " ";
        sentMsg[63:56] <= " ";
        cost <= 0;
    end
    else begin
        case(curr_state)
            IDLE:begin
                statusMsg[7:0] <= " ";
                statusMsg[15:8] <= " ";
                statusMsg[23:16] <= " ";
                statusMsg[31:24] <= " ";
                statusMsg[39:32] <= "E";
                statusMsg[47:40] <= "L";
                statusMsg[55:48] <= "D";
                statusMsg[63:56] <= "I";
                sentMsg[7:0] <= " ";
                sentMsg[15:8] <= " ";
                sentMsg[23:16] <= " ";
                sentMsg[31:24] <= " ";
                sentMsg[39:32] <= " ";
                sentMsg[47:40] <= " ";
                sentMsg[55:48] <= " ";
                sentMsg[63:56] <= " ";
                cost <= 0;
            end
            RINGING:begin
                statusMsg[7:0] <= " ";
                statusMsg[15:8] <= "G";
                statusMsg[23:16] <= "N";
                statusMsg[31:24] <= "I";
                statusMsg[39:32] <= "G";
                statusMsg[47:40] <= "N";
                statusMsg[55:48] <= "I";
                statusMsg[63:56] <= "R"; 
            end
            REJECTED:begin
                statusMsg[7:0] <= "D";
                statusMsg[15:8] <= "E";
                statusMsg[23:16] <= "T";
                statusMsg[31:24] <= "C";
                statusMsg[39:32] <= "E";
                statusMsg[47:40] <= "J";
                statusMsg[55:48] <= "E";
                statusMsg[63:56] <= "R";
            end
            BUSY:begin
                statusMsg[7:0] <= " ";
                statusMsg[15:8] <= " ";
                statusMsg[23:16] <= " ";
                statusMsg[31:24] <= " ";
                statusMsg[39:32] <= "Y";
                statusMsg[47:40] <= "S";
                statusMsg[55:48] <= "U";
                statusMsg[63:56] <= "B";
            end
            CALL:begin
                statusMsg[7:0] <= " ";
                statusMsg[15:8] <= " ";
                statusMsg[23:16] <= " ";
                statusMsg[31:24] <= " ";
                statusMsg[39:32] <= "L";
                statusMsg[47:40] <= "L";
                statusMsg[55:48] <= "A";
                statusMsg[63:56] <= "C";
                
                if((charSent == 127) & (sendChar == 1))
                    cost <= cost + 2;  
                else if((charSent >= 48) & (charSent <= 57) & (sendChar == 1))
                    begin
                        cost <= cost + 1;
                        sentMsg[63:8] = sentMsg[55:0];
                        sentMsg[7:0] = charSent;
                    end
                else if((charSent >= 32) & (charSent <= 126) & (sendChar == 1))
                    begin
                        cost <= cost + 2;
                        sentMsg[63:8] = sentMsg[55:0];
                        sentMsg[7:0] = charSent;
                    end
            end
            COST:begin
                statusMsg[7:0] <= " ";
                statusMsg[15:8] <= " ";
                statusMsg[23:16] <= " ";
                statusMsg[31:24] <= " ";
                statusMsg[39:32] <= "T";
                statusMsg[47:40] <= "S";
                statusMsg[55:48] <= "O";
                statusMsg[63:56] <= "C"; 
                sentMsg <= cost;
            end
        endcase
    end
end

endmodule
